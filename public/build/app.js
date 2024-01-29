(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tw_elements__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tw-elements */ "./node_modules/tw-elements/dist/js/tw-elements.es.min.js");
/* harmony import */ var _js_app_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/app.js */ "./assets/js/app.js");
/* harmony import */ var _js_app_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_app_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_3__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)




// NAVBAR JS ON 

(0,tw_elements__WEBPACK_IMPORTED_MODULE_0__.initTE)({
  Sidenav: tw_elements__WEBPACK_IMPORTED_MODULE_0__.Sidenav
});

(0,tw_elements__WEBPACK_IMPORTED_MODULE_0__.initTE)({
  Collapse: tw_elements__WEBPACK_IMPORTED_MODULE_0__.Collapse,
  Dropdown: tw_elements__WEBPACK_IMPORTED_MODULE_0__.Dropdown
});
// NAVBAR JS OFF

// // SELECT 2 JS ON

__webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");
jquery__WEBPACK_IMPORTED_MODULE_3___default()('.select2').select2();
// // SELECT 2 JS OFF

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.parse-float.js */ "./node_modules/core-js/modules/es.parse-float.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
__webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
// DUE DETTE JS ON 
{
  var inputDateDue = document.querySelector('#date-due');
  if (inputDateDue) {
    inputDateDue.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputDateDue);
    });
  }
  var inputClient = document.querySelector('#client');
  if (inputClient) {
    inputClient.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputClient);
    });
  }
  var inputProduitDette = document.querySelector('#produit_Dette');
  if (inputProduitDette) {
    inputProduitDette.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputProduitDette);
    });
  }
}
// DUE DETTE JS OFF

// FRAIS JS ON 
{
  var inputDateFrais = document.querySelector('#date-frais');
  if (inputDateFrais) {
    inputDateFrais.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputDateFrais);
    });
  }
  var selectFraisFiltre = document.querySelector('#dateJr-frais');
  if (selectFraisFiltre) {
    selectFraisFiltre.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, selectFraisFiltre);
    });
  }
}
// FRAIS JS OFF

// USERS JS ON 
{
  var inputUser = document.querySelector('#user');
  if (inputUser) {
    inputUser.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputUser);
    });
  }
}
// USERS JS OFF

// PRODUITS JS ON 
{
  var inputProduit = document.querySelector('#produit');
  if (inputProduit) {
    inputProduit.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputProduit);
    });
  }
  var selectFiltreProduit = document.querySelector('#select-filtre-Produit');
  if (selectFiltreProduit) {
    selectFiltreProduit.addEventListener("change", function (event) {
      SelectFiltreAsynchrone(event, selectFiltreProduit);
    });
  }
}
// PRODUITS JS OFF

// VENTE COMMANDE JS ON 
{
  var inputVente = document.querySelector('#date-vente');
  if (inputVente) {
    inputVente.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputVente);
    });
  }
  var inputClientVente = document.querySelector('#client_vente');
  if (inputClientVente) {
    inputClientVente.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputClientVente);
    });
  }
  var inputUsertVente = document.querySelector('#user_vente');
  if (inputUsertVente) {
    inputUsertVente.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputUsertVente);
    });
  }
}
// VENTE COMMANDE JS OFF

// CAISSE JS ON 
{
  var inputCaisse = document.querySelector('#date_caisse');
  if (inputCaisse) {
    inputCaisse.addEventListener("change", function (event) {
      inputFiltreAsynchrone(event, inputCaisse);
    });
  }
}
// CAISSE JS OFF

// POINT JS ON 
{
  var selectPoint = document.querySelector('#selectPoint');
  if (selectPoint) {
    selectPoint.addEventListener("change", function (event) {
      SelectFiltreAsynchrone(event, selectPoint);
    });
  }
}
// POINT JS ON 

// FORMULAIRE DE PRODUITS JS ON 
{
  var inputPrixAchat = document.querySelector('.prixAchatInput');
  var inputPrixVenteMin = document.querySelector('.prixVenteMinInput');
  console.log(inputPrixAchat);
  if (inputPrixAchat) {
    inputPrixAchat.addEventListener('keyup', function () {
      inputPrixVenteMin.value = parseFloat(inputPrixAchat.value) + parseFloat(inputPrixAchat.value * 20 / 100);
    });
  }
}
// FORMULAIRE DE PRODUITS JS ON 

function SelectFiltreAsynchrone(event, select) {
  var option = event.target.options[select.selectedIndex];
  var path = option.getAttribute('data-path');
  fetch(path, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  }).then(function (response) {
    return response.json();
  }).then(function (url) {
    window.location.href = url;
  })["catch"](function (err) {
    return console.log(err);
  });
}
function inputFiltreAsynchrone(event, input) {
  var path = "".concat(input.getAttribute('data-path'), "?attr").concat(input.id, "=").concat(input.value);
  fetch(path, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json'
    }
  }).then(function (response) {
    return response.json();
  }).then(function (url) {
    window.location.href = url;
  })["catch"](function (err) {
    return console.log(err);
  });
}

// PRINT JS ON 
{
  pExist = document.querySelector(".imprimer");
  if (pExist) {
    window.print();
  }
}
// PRINT JS OFF

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_select2_dist_js_select2_js-node_modules_select2_dist_css_select2_css-nod-c8a5b4"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QztFQUFBLEVBQUM7QUFDdkM7O0FBRUE7QUFDQTtFQUNJSSxNQUFNLEdBQUc3QyxRQUFRLENBQUNDLGFBQWEsQ0FBQyxXQUFXLENBQUM7RUFDNUMsSUFBSTRDLE1BQU0sRUFBRTtJQUNSUCxNQUFNLENBQUNRLEtBQUssQ0FBQyxDQUFDO0VBQ2xCO0FBQ0o7QUFDQTs7Ozs7Ozs7Ozs7O0FDektBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXG4gKi9cblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICd0dy1lbGVtZW50cyc7XG5pbXBvcnQgJy4vanMvYXBwLmpzJztcbmltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XG5cbi8vIE5BVkJBUiBKUyBPTiBcbmltcG9ydCB7XG4gICAgU2lkZW5hdixcbiAgICBpbml0VEUsXG4gIH0gZnJvbSBcInR3LWVsZW1lbnRzXCI7XG4gIFxuICBpbml0VEUoeyBTaWRlbmF2IH0pO1xuICBcbiAgaW1wb3J0IHtcbiAgICBDb2xsYXBzZSxcbiAgICBEcm9wZG93blxuICB9IGZyb20gXCJ0dy1lbGVtZW50c1wiO1xuICBcbiAgaW5pdFRFKHsgQ29sbGFwc2UsIERyb3Bkb3duIH0pO1xuICAvLyBOQVZCQVIgSlMgT0ZGXG5cbi8vIC8vIFNFTEVDVCAyIEpTIE9OXG5pbXBvcnQgJCBmcm9tICdqcXVlcnknO1xucmVxdWlyZSgnc2VsZWN0MicpXG4kKCcuc2VsZWN0MicpLnNlbGVjdDIoKTtcbi8vIC8vIFNFTEVDVCAyIEpTIE9GRlxuXG5cblxuXG4iLCJcblxuLy8gRFVFIERFVFRFIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0RGF0ZUR1ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGUtZHVlJyk7XG4gICAgaWYoaW5wdXREYXRlRHVlKXtcbiAgICAgICAgaW5wdXREYXRlRHVlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXREYXRlRHVlKTtcbiAgICAgICAgfSlcbiAgICB9ICAgIFxuICAgIFxuICAgIGNvbnN0IGlucHV0Q2xpZW50ID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjY2xpZW50Jyk7XG4gICAgaWYoaW5wdXRDbGllbnQpe1xuICAgICAgICBpbnB1dENsaWVudC5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0Q2xpZW50KTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG4gICAgXG4gICAgY29uc3QgaW5wdXRQcm9kdWl0RGV0dGUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcm9kdWl0X0RldHRlJyk7XG4gICAgaWYoaW5wdXRQcm9kdWl0RGV0dGUpe1xuICAgICAgICBpbnB1dFByb2R1aXREZXR0ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0UHJvZHVpdERldHRlKTtcbiAgICAgICAgfSlcbiAgICB9XG59XG4vLyBEVUUgREVUVEUgSlMgT0ZGXG5cbi8vIEZSQUlTIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0RGF0ZUZyYWlzID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZGF0ZS1mcmFpcycpO1xuICAgIGlmKGlucHV0RGF0ZUZyYWlzKXtcbiAgICAgICAgaW5wdXREYXRlRnJhaXMuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dERhdGVGcmFpcyk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxuICAgIFxuICAgIGNvbnN0IHNlbGVjdEZyYWlzRmlsdHJlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZGF0ZUpyLWZyYWlzJyk7XG4gICAgaWYoc2VsZWN0RnJhaXNGaWx0cmUpe1xuICAgICAgICBzZWxlY3RGcmFpc0ZpbHRyZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdEZyYWlzRmlsdHJlKTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG59XG4vLyBGUkFJUyBKUyBPRkZcblxuLy8gVVNFUlMgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRVc2VyID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjdXNlcicpO1xuICAgIGlmKGlucHV0VXNlcil7XG4gICAgICAgIGlucHV0VXNlci5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0VXNlcik7XG4gICAgICAgIH0pXG4gICAgfSAgIFxufVxuLy8gVVNFUlMgSlMgT0ZGXG5cbi8vIFBST0RVSVRTIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0UHJvZHVpdCA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3Byb2R1aXQnKTtcbiAgICBpZihpbnB1dFByb2R1aXQpe1xuICAgICAgICBpbnB1dFByb2R1aXQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFByb2R1aXQpO1xuICAgICAgICB9KVxuICAgIH0gICBcblxuICAgIGNvbnN0IHNlbGVjdEZpbHRyZVByb2R1aXQgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNzZWxlY3QtZmlsdHJlLVByb2R1aXQnKTtcbiAgICBpZihzZWxlY3RGaWx0cmVQcm9kdWl0KXtcbiAgICAgICAgc2VsZWN0RmlsdHJlUHJvZHVpdC5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgU2VsZWN0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3RGaWx0cmVQcm9kdWl0KTtcbiAgICAgICAgfSlcbiAgICB9XG59XG4vLyBQUk9EVUlUUyBKUyBPRkZcblxuLy8gVkVOVEUgQ09NTUFOREUgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRWZW50ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGUtdmVudGUnKTtcbiAgICBpZihpbnB1dFZlbnRlKXtcbiAgICAgICAgaW5wdXRWZW50ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0VmVudGUpO1xuICAgICAgICB9KVxuICAgIH1cbiAgICBjb25zdCBpbnB1dENsaWVudFZlbnRlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjY2xpZW50X3ZlbnRlJyk7XG4gICAgaWYoaW5wdXRDbGllbnRWZW50ZSl7XG4gICAgICAgIGlucHV0Q2xpZW50VmVudGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dENsaWVudFZlbnRlKTtcbiAgICAgICAgfSlcbiAgICB9XG4gICAgY29uc3QgaW5wdXRVc2VydFZlbnRlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjdXNlcl92ZW50ZScpO1xuICAgIGlmKGlucHV0VXNlcnRWZW50ZSl7XG4gICAgICAgIGlucHV0VXNlcnRWZW50ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0VXNlcnRWZW50ZSk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gVkVOVEUgQ09NTUFOREUgSlMgT0ZGXG5cbi8vIENBSVNTRSBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dENhaXNzZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGVfY2Fpc3NlJyk7XG4gICAgaWYoaW5wdXRDYWlzc2Upe1xuICAgICAgICBpbnB1dENhaXNzZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0Q2Fpc3NlKTtcbiAgICAgICAgfSlcbiAgICB9XG59XG4vLyBDQUlTU0UgSlMgT0ZGXG5cbi8vIFBPSU5UIEpTIE9OIFxue1xuICAgIGNvbnN0IHNlbGVjdFBvaW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3NlbGVjdFBvaW50Jyk7XG4gICAgaWYoc2VsZWN0UG9pbnQpe1xuICAgICAgICBzZWxlY3RQb2ludC5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgU2VsZWN0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3RQb2ludCk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gUE9JTlQgSlMgT04gXG5cbi8vIEZPUk1VTEFJUkUgREUgUFJPRFVJVFMgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRQcml4QWNoYXQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcucHJpeEFjaGF0SW5wdXQnKTtcbiAgICBjb25zdCBpbnB1dFByaXhWZW50ZU1pbiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5wcml4VmVudGVNaW5JbnB1dCcpO1xuICAgIGNvbnNvbGUubG9nKGlucHV0UHJpeEFjaGF0KVxuICAgIGlmKGlucHV0UHJpeEFjaGF0KXtcbiAgICAgICAgaW5wdXRQcml4QWNoYXQuYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCgpID0+e1xuICAgICAgICAgICAgICAgIGlucHV0UHJpeFZlbnRlTWluLnZhbHVlID0gcGFyc2VGbG9hdChpbnB1dFByaXhBY2hhdC52YWx1ZSkgKyBwYXJzZUZsb2F0KGlucHV0UHJpeEFjaGF0LnZhbHVlICogMjAgLyAxMDApO1xuICAgICAgICAgICAgfVxuICAgICAgICApXG4gICAgfVxufVxuLy8gRk9STVVMQUlSRSBERSBQUk9EVUlUUyBKUyBPTiBcblxuZnVuY3Rpb24gU2VsZWN0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3Qpe1xuICAgIGNvbnN0IG9wdGlvbj1ldmVudC50YXJnZXQub3B0aW9uc1tzZWxlY3Quc2VsZWN0ZWRJbmRleF07XG4gICAgY29uc3QgcGF0aD1vcHRpb24uZ2V0QXR0cmlidXRlKCdkYXRhLXBhdGgnKSAgXG4gICAgZmV0Y2gocGF0aCx7XG4gICAgbWV0aG9kOiAnR0VUJyxcbiAgICBoZWFkZXJzOiB7XG4gICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgIH1cbiAgICB9KS50aGVuKHJlc3BvbnNlID0+IHJlc3BvbnNlLmpzb24oKSlcbiAgICAudGhlbih1cmwgPT4ge1xuICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZj11cmw7XG4gICAgfSlcbiAgICAuY2F0Y2goZXJyID0+IGNvbnNvbGUubG9nKGVycikpXG59XG5cbmZ1bmN0aW9uIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dCl7XG4gICAgY29uc3QgcGF0aCA9IGAke2lucHV0LmdldEF0dHJpYnV0ZSgnZGF0YS1wYXRoJyl9P2F0dHIke2lucHV0LmlkfT0ke2lucHV0LnZhbHVlfWAgICAgICAgXG4gICAgZmV0Y2gocGF0aCx7XG4gICAgICAgIG1ldGhvZDogJ0dFVCcsXG4gICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICB9XG4gICAgICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4gcmVzcG9uc2UuanNvbigpKVxuICAgICAgICAudGhlbih1cmwgPT4ge1xuICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZj11cmw7XG4gICAgICAgIH0pXG4gICAgICAgIC5jYXRjaChlcnIgPT4gY29uc29sZS5sb2coZXJyKSkgIFxufVxuXG4vLyBQUklOVCBKUyBPTiBcbntcbiAgICBwRXhpc3QgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKFwiLmltcHJpbWVyXCIpXG4gICAgaWYgKHBFeGlzdCkge1xuICAgICAgICB3aW5kb3cucHJpbnQoKVxuICAgIH1cbn1cbi8vIFBSSU5UIEpTIE9GRlxuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbIlNpZGVuYXYiLCJpbml0VEUiLCJDb2xsYXBzZSIsIkRyb3Bkb3duIiwiJCIsInJlcXVpcmUiLCJzZWxlY3QyIiwiaW5wdXREYXRlRHVlIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwiYWRkRXZlbnRMaXN0ZW5lciIsImV2ZW50IiwiaW5wdXRGaWx0cmVBc3luY2hyb25lIiwiaW5wdXRDbGllbnQiLCJpbnB1dFByb2R1aXREZXR0ZSIsImlucHV0RGF0ZUZyYWlzIiwic2VsZWN0RnJhaXNGaWx0cmUiLCJpbnB1dFVzZXIiLCJpbnB1dFByb2R1aXQiLCJzZWxlY3RGaWx0cmVQcm9kdWl0IiwiU2VsZWN0RmlsdHJlQXN5bmNocm9uZSIsImlucHV0VmVudGUiLCJpbnB1dENsaWVudFZlbnRlIiwiaW5wdXRVc2VydFZlbnRlIiwiaW5wdXRDYWlzc2UiLCJzZWxlY3RQb2ludCIsImlucHV0UHJpeEFjaGF0IiwiaW5wdXRQcml4VmVudGVNaW4iLCJjb25zb2xlIiwibG9nIiwidmFsdWUiLCJwYXJzZUZsb2F0Iiwic2VsZWN0Iiwib3B0aW9uIiwidGFyZ2V0Iiwib3B0aW9ucyIsInNlbGVjdGVkSW5kZXgiLCJwYXRoIiwiZ2V0QXR0cmlidXRlIiwiZmV0Y2giLCJtZXRob2QiLCJoZWFkZXJzIiwidGhlbiIsInJlc3BvbnNlIiwianNvbiIsInVybCIsIndpbmRvdyIsImxvY2F0aW9uIiwiaHJlZiIsImVyciIsImlucHV0IiwiY29uY2F0IiwiaWQiLCJwRXhpc3QiLCJwcmludCJdLCJzb3VyY2VSb290IjoiIn0=