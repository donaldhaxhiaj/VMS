// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function (window, $) {
	var CPScanID = function () {

	};

	CPScanID.prototype = {
		defaults: {
			callbackReadSuccess: function () {
			},
			callbackReadFail: function () {
			},
			callbackDisconnect: function () {
			},
			extensionDownload: "http://tekreja.al/extension/ScanIDHostSetup.msi"
		},

		isInit: false,

		init: function (options) {
			if (this.isInit) {
				throw "IS_INITIATED";
			}
			if (!this.checkExtension()) {
				throw "EXTENSION_NOT_FOUND";
			}

			this.isInit = true;
			this.reconfigure(options);

			var self = this;
			window.addEventListener("message", function (response) {
				if (response.data.type === "CP_SCAN_FUNCTION_RESPONSE") {
					self.processResponse(response.data.data);
				}
				if (response.data.type === "CP_SCAN_HOST_DISCONNECTED") {
					self.config.callbackDisconnect();
				}
			});
			this.connect();
			return this;
		},

		processResponse: function (data) {
			var response = {};
			if (!data.Success || data.Status !== "READ") {
				response.Status = data.Status;
				this.config.callbackReadFail(response);
			} else if (data.Document.DocumentType === "PR_DOC_UNKNOWN") {
				response.Status = "UNKNOWN_DOCUMENT";
				this.config.callbackReadFail(response);
			} else if (data.Document.DocumentStatus === "Warning") {
				response.Status = "READ_WARNING";
				this.config.callbackReadFail(response);
			} else if (data.Document.DocumentStatus === "Error") {
				response.Status = "READ_ERROR";
				this.config.callbackReadFail(response);
			}
			else {
				this.config.callbackReadSuccess(data.Document.DocumentFields);
			}
		},

		reconfigure: function (options) {
			this.checkInit();
			this.options = options;
			this.config = $.extend({}, this.defaults, this.options);
			return this;
		},

		checkInit: function () {
			if (!this.isInit) {
				throw "NOT_INITIATED";
			}
			return this;
		},

		checkExtension: function () {
			return $("html").hasClass("CPScanID");
		},

		getExtensionUrl: function () {
			return this.config.extensionDownload;
		},

		connect: function () {
			this.checkInit();
			window.postMessage({
				type: "CP_SCAN_HOST_CONNECT",
				params: ""
			}, "*");
			return this;
		},

		disconnect: function () {
			this.checkInit();
			window.postMessage({
				type: "CP_SCAN_HOST_DISCONNECT",
				params: ""
			}, "*");
			return this;
		},

		exitHost: function () {
			this.checkInit();
			window.postMessage({
				type: "CP_SCAN_CALL_FUNCTION",
				params: {"cmd": "EXIT"}
			}, "*");
			return this;
		},

		read: function () {
			this.checkInit();
			window.postMessage({
				type: "CP_SCAN_CALL_FUNCTION",
				params: {"cmd": "READ_ID", "autodetect": "false"}
			}, "*");
			return this;
		},

		readAutoDetect: function () {
			this.checkInit();
			window.postMessage({
				type: "CP_SCAN_CALL_FUNCTION",
				params: {"cmd": "READ_ID"}
			}, "*");
			return this;
		}
	};

	CPScanID.defaults = CPScanID.prototype.defaults;

	$.CPScanID = new CPScanID();

})(window, jQuery);

