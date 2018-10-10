// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
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

            this.isInit = true;
            this.reconfigure(options);

            if (!this.checkExtension()) {
                throw "EXTENSION_NOT_FOUND";
            }

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

var Nationalities = {
    'AFG': 'Afghanistan',
    'ALB': 'Albania',
    'DZA': 'Algeria',
    'AND': 'Andorra',
    'AGO': 'Angola',
    'ATG': 'Antigua and Barbuda',
    'ARG': 'Argentina',
    'ARM': 'Armenia',
    'AUS': 'Australia',
    'AUT': 'Austria',
    'AZE': 'Azerbaijan',
    'BHS': 'Bahamas',
    'BHR': 'Bahrain',
    'BGD': 'Bangladesh',
    'BRB': 'Barbados',
    'BLR': 'Belarus',
    'BEL': 'Belgium',
    'BLZ': 'Belize',
    'BEN': 'Benin',
    'BTN': 'Bhutan',
    'BOL': 'Bolivia, Plurinational State of',
    'BIH': 'Bosnia and Herzegovina',
    'BWA': 'Botswana',
    'BRA': 'Brazil',
    'BRN': 'Brunei Darussalam',
    'BGR': 'Bulgaria',
    'BFA': 'Burkina Faso',
    'BDI': 'Burundi',
    'KHM': 'Cambodia',
    'CMR': 'Cameroon',
    'CAN': 'Canada',
    'CPV': 'Cabo Verde',
    'CAF': 'Central African Republic',
    'TCD': 'Chad',
    'CHL': 'Chile',
    'CHN': 'China',
    'COL': 'Colombia',
    'COM': 'Comoros',
    'COG': 'Congo',
    'COD': 'Congo, the Democratic Republic of the',
    'CRI': 'Costa Rica',
    'CIV': 'Côte d\'Ivoire',
    'HRV': 'Croatia',
    'CUB': 'Cuba',
    'CYP': 'Cyprus',
    'CZE': 'Czech Republic',
    'DNK': 'Denmark',
    'DJI': 'Djibouti',
    'DMA': 'Dominica',
    'DOM': 'Dominican Republic',
    'ECU': 'Ecuador',
    'EGY': 'Egypt',
    'SLV': 'El Salvador',
    'GNQ': 'Equatorial Guinea',
    'ERI': 'Eritrea',
    'EST': 'Estonia',
    'ETH': 'Ethiopia',
    'FJI': 'Fiji',
    'FIN': 'Finland',
    'FRA': 'France',
    'GAB': 'Gabon',
    'GMB': 'Gambia',
    'GEO': 'Georgia',
    'DEU': 'Germany',
    'GHA': 'Ghana',
    'GRC': 'Greece',
    'GRD': 'Grenada',
    'GTM': 'Guatemala',
    'GIN': 'Guinea',
    'GNB': 'Guinea-Bissau',
    'GUY': 'Guyana',
    'HTI': 'Haiti',
    'VAT': 'Holy See (Vatican City State)',
    'HND': 'Honduras',
    'HUN': 'Hungary',
    'ISL': 'Iceland',
    'IND': 'India',
    'IDN': 'Indonesia',
    'IRN': 'Iran, Islamic Republic of',
    'IRQ': 'Iraq',
    'IRL': 'Ireland',
    'ISR': 'Israel',
    'ITA': 'Italy',
    'JAM': 'Jamaica',
    'JPN': 'Japan',
    'JOR': 'Jordan',
    'KAZ': 'Kazakhstan',
    'KEN': 'Kenya',
    'KIR': 'Kiribati',
    'KOR': 'Korea, Republic of',
    'KWT': 'Kuwait',
    'KGZ': 'Kyrgyzstan',
    'LAO': 'Lao People\'s Democratic Republic',
    'LVA': 'Latvia',
    'LBN': 'Lebanon',
    'LSO': 'Lesotho',
    'LBR': 'Liberia',
    'LBY': 'Libya',
    'LIE': 'Liechtenstein',
    'LTU': 'Lithuania',
    'LUX': 'Luxembourg',
    'MKD': 'Macedonia, The Former Yugoslav Republic of',
    'MDG': 'Madagascar',
    'MWI': 'Malawi',
    'MYS': 'Malaysia',
    'MDV': 'Maldives',
    'MLI': 'Mali',
    'MLT': 'Malta',
    'MHL': 'Marshall Islands',
    'MRT': 'Mauritania',
    'MUS': 'Mauritius',
    'MEX': 'Mexico',
    'FSM': 'Micronesia, Federated States of',
    'MDA': 'Moldova, Republic of',
    'MCO': 'Monaco',
    'MNG': 'Mongolia',
    'MNE': 'Montenegro',
    'MAR': 'Morocco',
    'MOZ': 'Mozambique',
    'MMR': 'Myanmar',
    'NAM': 'Namibia',
    'NRU': 'Nauru',
    'NPL': 'Nepal',
    'NLD': 'Netherlands',
    'NZL': 'New Zealand',
    'NIC': 'Nicaragua',
    'NER': 'Niger',
    'NGA': 'Nigeria',
    'NOR': 'Norway',
    'OMN': 'Oman',
    'PAK': 'Pakistan',
    'PLW': 'Palau',
    'PSE': 'Palestine, State of',
    'PAN': 'Panama',
    'PNG': 'Papua New Guinea',
    'PRY': 'Paraguay',
    'PER': 'Peru',
    'PHL': 'Philippines',
    'POL': 'Poland',
    'PRT': 'Portugal',
    'QAT': 'Qatar',
    'ROU': 'Romania',
    'RUS': 'Russian Federation',
    'RWA': 'Rwanda',
    'KNA': 'Saint Kitts and Nevis',
    'LCA': 'Saint Lucia',
    'VCT': 'Saint Vincent and the Grenadines',
    'WSM': 'Samoa',
    'SMR': 'San Marino',
    'STP': 'Sao Tome and Principe',
    'SAU': 'Saudi Arabia',
    'SEN': 'Senegal',
    'SRB': 'Serbia',
    'SYC': 'Seychelles',
    'SLE': 'Sierra Leone',
    'SGP': 'Singapore',
    'SVK': 'Slovakia',
    'SVN': 'Slovenia',
    'SLB': 'Solomon Islands',
    'SOM': 'Somalia',
    'ZAF': 'South Africa',
    'SSD': 'South Sudan',
    'ESP': 'Spain',
    'LKA': 'Sri Lanka',
    'SDN': 'Sudan',
    'SUR': 'Suriname',
    'SWZ': 'Swaziland',
    'SWE': 'Sweden',
    'CHE': 'Switzerland',
    'SYR': 'Syrian Arab Republic',
    'TWN': 'Taiwan, Province of China',
    'TJK': 'Tajikistan',
    'TZA': 'Tanzania, United Republic of',
    'THA': 'Thailand',
    'TLS': 'Timor-Leste',
    'TGO': 'Togo',
    'TON': 'Tonga',
    'TTO': 'Trinidad and Tobago',
    'TUN': 'Tunisia',
    'TUR': 'Turkey',
    'TKM': 'Turkmenistan',
    'TUV': 'Tuvalu',
    'UGA': 'Uganda',
    'UKR': 'Ukraine',
    'ARE': 'United Arab Emirates',
    'GBR': 'United Kingdom',
    'USA': 'United States',
    'URY': 'Uruguay',
    'UZB': 'Uzbekistan',
    'VUT': 'Vanuatu',
    'VEN': 'Venezuela, Bolivarian Republic of',
    'VNM': 'Viet Nam',
    'ESH': 'Western Sahara',
    'YEM': 'Yemen',
    'ZMB': 'Zambia',
    'ZWE': 'Zimbabwe'
};
