# CPScanID

### Pershkrim
Kjo librari sherben per t'u integruar me browser extension te zhvilluar per te komunikuar me pajisjet Combo Scanner te ARH dhe per te realizuar me tej integrimin me nje nderfaqe web ne nivel klienti (client-side).
Perdorimi i librarise ka si prerekuizite perfshirjen e librarise jQuery (si me poshte).
Ne menyre te vecante i duhet kushtuar kujdes mospasjes se extension+Native Message Host application te instaluar te klienti. Ne kete rast libraria ngre nje exeption dhe perdoruesit i duhet dhene mesazhi perkates si dhe informimi se ku mund te shkarkoje instaluesin (URL per download).
Cdo metode e librarise behet e perdorshme **VETEM** pasi te therritet metoda *init* me parametrat respektiv, perndryshe therritja e metodave ngre nje exeption.

## Perdorimi

1. Perfshi jQuery:

	```html
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	```

2. Perfshi librarine:

	```html
	<script src="dist/jquery.cpscanid.min.js"></script>
	```

3. Inicializo Librarine
	```javascript
	// inicializo vetem nje here librarine (per ndryshime duhet therritur metoda rikonfiguruese)
	$.CPScanID.init({
	        callbackReadSuccess: function (data) {
	            console.log("Success: ", data);
	        },
	        callbackReadFail: function (data) {
	            console.log("Fail: ", data);
	        },
	        callbackDisconnect: function () {
	            console.log("Disconnected");
	        }
	    });
	```
4. Perdor metodat lexuese
	```javascript
	    // aktivizimi i leximit me autodedektim kur klikohet butoni (mund te aktivizohet qe ne dom.load)
	    $("#read-auto-btn").on("click", function () {
	        $.CPScanID.readAutoDetect();
	    });
	    // aktivizimi i leximit ne momentin qe klikohet butoni (mjeti i identifikimit duhet te jete i vendosur paraprakisht)
	    $("#read-manual-btn").on("click", function () {
	        $.CPScanID.read();
	    });
	```
5. Shembull i integruar

	```javascript
	$(function () {
	        // inicializim
    	        $.CPScanID.init({
    		callbackReadSuccess: function (data) {
    			console.log("Success: ", data);
    		},
    		callbackReadFail: function (data) {
    			console.log("Fail: ", data);
    		},
    		callbackDisconnect: function () {
    			console.log("Disconnected");
    		}
    	        });
	        // lexim me autodedektim
	        $("#read-auto-btn").on("click", function () {
	            $.CPScanID.readAutoDetect();
	        });
	        // lexim ne moment
	        $("#read-manual-btn").on("click", function () {
	            $.CPScanID.read();
	        });
	});
	```

## Struktura


```
├── dist/
│   └── jquery.cpscanid.min.js
├── src/
│   └── jquery.cpscanid.js
├── .editorconfig
├── .gitignore
├── .jshintrc
```

## Guida

#### Exeptions per trajtim
1. ```IS_INITIATED``` nese therritet per here te dyte metoda init (kjo librari eshte e zhvilluar ne modelin **Singleton**)
2. ```EXTENSION_NOT_FOUND``` ne init, behet kontroll nese extension nuk eshte i instaluar. Duhet qe perdoruesi te drejtohet nepermjet mesazhit te gabimit per te zbritur instaluesin (.MSI) ne URL e parakonfiguruar, *metoda: ``` getExtensionUrl()```*
3. ```NOT_INITIATED``` ne therritjen e cdo metode te librarise, nese nuk eshte therritur paraprakisht metoda init

Sugjerohet perdorimi i *try-catch* gjate therritjes se metodave dhe trajtimi i gabimeve me mesazhet perkatese. Shembull:

```javascript
	$(function () {
	        try{
                        $.CPScanID.init({
                            callbackReadSuccess: function (data) {
                                console.log("Success: ", data);
                            },
                            callbackReadFail: function (data) {
                                console.log("Fail: ", data);
                            },
                            callbackDisconnect: function () {
                                console.log("Disconnected");
                            }
                        });
	        } catch(err){
	            switch(err){
	                case "IS_INITIATED": alert("Eshte inicializuar nje here!");break;
	                case "EXTENSION_NOT_FOUND": alert("Duhet instaluar extension, vizitoni url-ne: "+$.CPScanID.getExtensionUrl());break;
	                default: alert("Ka ndodhur nje gabim");
	            }
	        }

                     $("#read-manual-btn").on("click", function () {
	            try{
	                $.CPScanID.read();
	            } catch(err){
	                if(err=="NOT_INITIATED"){
	                    alert("Libraria nuk eshte inicializuar ende");
	                }
	            }
	        });
	});
```

#### callbackReadFail
Per te marre informacionet e nevojshme ne rast deshtimi te leximit si dhe per te informuar perdoruesin, perdoret metoda e specifikuar si parameter ne *init* callbackReadFail.
Kjo metode merr nje parameter objekt i cili permban vetine *Status*. Vlerat e mundshme jane:

| Status        | Pershkrimi           |
| ------------- |:-------------|
|   INVALID_STATE    | Driver i pajisjes nuk eshte ne gjendje te ktheje pergjigje |
| CANNOT_CONNECT_DEVICE      | Lidhja me pajisjen eshte e pamundur te kryhet, pajisja mund te jete duke u perdorur nga ndonje proces tjeter ose gjendet ne nje gjendje jo stabel      |
| POWERED_OFF | Pajisja eshte e fikur (per ato pajisje qe mund te fiken me buton apo me software     |
| INVALID_DETECTION_STATE | Nuk eshte ne gjendje te dedektohet imazhi     |
| IMAGE_NOT_CAPTURED | Nuk u fotografua asnje imazh prej pajisjes     |
| NO_MRZ_DATA | Ne imazh nuk gjendet asnje informacion MRZ    |
| UNKNOWN_DOCUMENT | Dokumenti i fotografuar nuk eshte ne nje format te njohur, ose duhet pozicionuar sakte     |
| READ_WARNING | Imazhi u lexua por me gabime te tolerueshme, duhet pare pozicioni i dokumentit ne dritaren e skanerit, ose statuset respektive per cdo fushe     |
| READ_ERROR | Gabim me i rende ne lexim se READ_WARNING (ka te njejten natyre si READ_WARNING)     |

#### callbackReadSuccess
Ne procesim te suksesshem, kjo metode therritet dhe parametrizohet me vektorin e te dhenave te lexuara nga kodi MRZ.
Cdo element i vektorit vjen i indeksuar me nje kod qe identifikon fushen dhe vlera permbahet ne nje objekt se bashku me statusin me te cilin u lexua (Ok, Warning, Error). Formati i nje elementi te vektorit eshte: ```{10132:{Value: "ALB", Status: "Ok"}}```

#### callbackDisconnect
Kjo metode therritet sa here procesi i cili komunikon me pajisjen (Native Messaging Host) mbyllet ne menyre te sforcuar (crash).
Nuk eshte parameter i detyrueshem per t'u konfiguruar ne *init*.

#### Lista e plote e metodave
 * ```init``` metoda inicializues i librarise, merr si parameter nje objekt (si ne shembujt me siper)
 * ```processResponse``` metode private, perdoret per te trajtuar pergjigjen qe vjen nga komunikimi me extension
 * ```reconfigure``` metode e parametrizuar njesoj si *init*, sherben per te ndryshuar metodat qe do therriten ne callback
 * ```checkInit``` metode private, teston nese libraria eshte e inicializuar
 * ```checkExtension``` metode private, teston nese extension eshte instaluar
 * ```getExtensionUrl``` metode qe kthen URL e instaluesit (.MSI)
 * ```connect``` metode qe therritet ne *init*, mundeson dhe siguron lidhjen me extension, dhe me tej extension me Native Message Host
 * ```disconnect``` metode qe mundeson mbylljen e kanalit te komunikimit me extension (nuk eshte i nevojshem perdorimi per shkak te natyres se extension-it)
 * ```exitHost``` metode qe mundeson daljen e aplikacionit background qe mundeson komunikimin me pajisjen (Native Messaging Host)
 * ```read``` metode qe perdoret per te iniciuar leximin ne pajisje ne menyre manuale, pra ne momentin qe therritet kjo metode
 * ```readAutoDetect``` metode qe perdoret per te iniciuar leximin ne pajisje ne menyre automatike, duke dedektuar levizjen e dokumentit mbi dritare dhe pranine e tij



## Licenca

[Apache License](http://commprog.com/) © Communication Progress
