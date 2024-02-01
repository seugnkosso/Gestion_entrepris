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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QztFQUFBLEVBQUM7QUFDdkM7O0FBRUE7QUFDQTtFQUNJSSxNQUFNLEdBQUc3QyxRQUFRLENBQUNDLGFBQWEsQ0FBQyxXQUFXLENBQUM7RUFDNUMsSUFBSTRDLE1BQU0sRUFBRTtJQUNSUCxNQUFNLENBQUNRLEtBQUssQ0FBQyxDQUFDO0VBQ2xCO0FBQ0o7QUFDQTs7Ozs7Ozs7Ozs7O0FDektBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcz82YmU2Il0sInNvdXJjZXNDb250ZW50IjpbIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJ3R3LWVsZW1lbnRzJztcbmltcG9ydCAnLi9qcy9hcHAuanMnO1xuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcblxuLy8gTkFWQkFSIEpTIE9OIFxuaW1wb3J0IHtcbiAgICBTaWRlbmF2LFxuICAgIGluaXRURSxcbiAgfSBmcm9tIFwidHctZWxlbWVudHNcIjtcbiAgXG4gIGluaXRURSh7IFNpZGVuYXYgfSk7XG4gIFxuICBpbXBvcnQge1xuICAgIENvbGxhcHNlLFxuICAgIERyb3Bkb3duXG4gIH0gZnJvbSBcInR3LWVsZW1lbnRzXCI7XG4gIFxuICBpbml0VEUoeyBDb2xsYXBzZSwgRHJvcGRvd24gfSk7XG4gIC8vIE5BVkJBUiBKUyBPRkZcblxuLy8gLy8gU0VMRUNUIDIgSlMgT05cbmltcG9ydCAkIGZyb20gJ2pxdWVyeSc7XG5yZXF1aXJlKCdzZWxlY3QyJylcbiQoJy5zZWxlY3QyJykuc2VsZWN0MigpO1xuLy8gLy8gU0VMRUNUIDIgSlMgT0ZGXG5cblxuXG5cbiIsIlxuXG4vLyBEVUUgREVUVEUgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXREYXRlRHVlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZGF0ZS1kdWUnKTtcbiAgICBpZihpbnB1dERhdGVEdWUpe1xuICAgICAgICBpbnB1dERhdGVEdWUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dERhdGVEdWUpO1xuICAgICAgICB9KVxuICAgIH0gICAgXG4gICAgXG4gICAgY29uc3QgaW5wdXRDbGllbnQgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNjbGllbnQnKTtcbiAgICBpZihpbnB1dENsaWVudCl7XG4gICAgICAgIGlucHV0Q2xpZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRDbGllbnQpO1xuICAgICAgICB9KVxuICAgIH0gICBcbiAgICBcbiAgICBjb25zdCBpbnB1dFByb2R1aXREZXR0ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3Byb2R1aXRfRGV0dGUnKTtcbiAgICBpZihpbnB1dFByb2R1aXREZXR0ZSl7XG4gICAgICAgIGlucHV0UHJvZHVpdERldHRlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRQcm9kdWl0RGV0dGUpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIERVRSBERVRURSBKUyBPRkZcblxuLy8gRlJBSVMgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXREYXRlRnJhaXMgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlLWZyYWlzJyk7XG4gICAgaWYoaW5wdXREYXRlRnJhaXMpe1xuICAgICAgICBpbnB1dERhdGVGcmFpcy5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0RGF0ZUZyYWlzKTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG4gICAgXG4gICAgY29uc3Qgc2VsZWN0RnJhaXNGaWx0cmUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlSnItZnJhaXMnKTtcbiAgICBpZihzZWxlY3RGcmFpc0ZpbHRyZSl7XG4gICAgICAgIHNlbGVjdEZyYWlzRmlsdHJlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsc2VsZWN0RnJhaXNGaWx0cmUpO1xuICAgICAgICB9KVxuICAgIH0gICBcbn1cbi8vIEZSQUlTIEpTIE9GRlxuXG4vLyBVU0VSUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dFVzZXIgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyN1c2VyJyk7XG4gICAgaWYoaW5wdXRVc2VyKXtcbiAgICAgICAgaW5wdXRVc2VyLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRVc2VyKTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG59XG4vLyBVU0VSUyBKUyBPRkZcblxuLy8gUFJPRFVJVFMgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRQcm9kdWl0ID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjcHJvZHVpdCcpO1xuICAgIGlmKGlucHV0UHJvZHVpdCl7XG4gICAgICAgIGlucHV0UHJvZHVpdC5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0UHJvZHVpdCk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxuXG4gICAgY29uc3Qgc2VsZWN0RmlsdHJlUHJvZHVpdCA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3NlbGVjdC1maWx0cmUtUHJvZHVpdCcpO1xuICAgIGlmKHNlbGVjdEZpbHRyZVByb2R1aXQpe1xuICAgICAgICBzZWxlY3RGaWx0cmVQcm9kdWl0LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdEZpbHRyZVByb2R1aXQpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIFBST0RVSVRTIEpTIE9GRlxuXG4vLyBWRU5URSBDT01NQU5ERSBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dFZlbnRlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZGF0ZS12ZW50ZScpO1xuICAgIGlmKGlucHV0VmVudGUpe1xuICAgICAgICBpbnB1dFZlbnRlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRWZW50ZSk7XG4gICAgICAgIH0pXG4gICAgfVxuICAgIGNvbnN0IGlucHV0Q2xpZW50VmVudGUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNjbGllbnRfdmVudGUnKTtcbiAgICBpZihpbnB1dENsaWVudFZlbnRlKXtcbiAgICAgICAgaW5wdXRDbGllbnRWZW50ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0Q2xpZW50VmVudGUpO1xuICAgICAgICB9KVxuICAgIH1cbiAgICBjb25zdCBpbnB1dFVzZXJ0VmVudGUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyN1c2VyX3ZlbnRlJyk7XG4gICAgaWYoaW5wdXRVc2VydFZlbnRlKXtcbiAgICAgICAgaW5wdXRVc2VydFZlbnRlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRVc2VydFZlbnRlKTtcbiAgICAgICAgfSlcbiAgICB9XG59XG4vLyBWRU5URSBDT01NQU5ERSBKUyBPRkZcblxuLy8gQ0FJU1NFIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0Q2Fpc3NlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjZGF0ZV9jYWlzc2UnKTtcbiAgICBpZihpbnB1dENhaXNzZSl7XG4gICAgICAgIGlucHV0Q2Fpc3NlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRDYWlzc2UpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIENBSVNTRSBKUyBPRkZcblxuLy8gUE9JTlQgSlMgT04gXG57XG4gICAgY29uc3Qgc2VsZWN0UG9pbnQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjc2VsZWN0UG9pbnQnKTtcbiAgICBpZihzZWxlY3RQb2ludCl7XG4gICAgICAgIHNlbGVjdFBvaW50LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdFBvaW50KTtcbiAgICAgICAgfSlcbiAgICB9XG59XG4vLyBQT0lOVCBKUyBPTiBcblxuLy8gRk9STVVMQUlSRSBERSBQUk9EVUlUUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dFByaXhBY2hhdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5wcml4QWNoYXRJbnB1dCcpO1xuICAgIGNvbnN0IGlucHV0UHJpeFZlbnRlTWluID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnByaXhWZW50ZU1pbklucHV0Jyk7XG4gICAgY29uc29sZS5sb2coaW5wdXRQcml4QWNoYXQpXG4gICAgaWYoaW5wdXRQcml4QWNoYXQpe1xuICAgICAgICBpbnB1dFByaXhBY2hhdC5hZGRFdmVudExpc3RlbmVyKCdrZXl1cCcsKCkgPT57XG4gICAgICAgICAgICAgICAgaW5wdXRQcml4VmVudGVNaW4udmFsdWUgPSBwYXJzZUZsb2F0KGlucHV0UHJpeEFjaGF0LnZhbHVlKSArIHBhcnNlRmxvYXQoaW5wdXRQcml4QWNoYXQudmFsdWUgKiAyMCAvIDEwMCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIClcbiAgICB9XG59XG4vLyBGT1JNVUxBSVJFIERFIFBST0RVSVRTIEpTIE9OIFxuXG5mdW5jdGlvbiBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdCl7XG4gICAgY29uc3Qgb3B0aW9uPWV2ZW50LnRhcmdldC5vcHRpb25zW3NlbGVjdC5zZWxlY3RlZEluZGV4XTtcbiAgICBjb25zdCBwYXRoPW9wdGlvbi5nZXRBdHRyaWJ1dGUoJ2RhdGEtcGF0aCcpICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICBtZXRob2Q6ICdHRVQnLFxuICAgIGhlYWRlcnM6IHtcbiAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgfVxuICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4gcmVzcG9uc2UuanNvbigpKVxuICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICB9KVxuICAgIC5jYXRjaChlcnIgPT4gY29uc29sZS5sb2coZXJyKSlcbn1cblxuZnVuY3Rpb24gaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0KXtcbiAgICBjb25zdCBwYXRoID0gYCR7aW5wdXQuZ2V0QXR0cmlidXRlKCdkYXRhLXBhdGgnKX0/YXR0ciR7aW5wdXQuaWR9PSR7aW5wdXQudmFsdWV9YCAgICAgICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICAgICAgbWV0aG9kOiAnR0VUJyxcbiAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgICAgIH1cbiAgICAgICAgfSkudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS5qc29uKCkpXG4gICAgICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICAgICAgfSlcbiAgICAgICAgLmNhdGNoKGVyciA9PiBjb25zb2xlLmxvZyhlcnIpKSAgXG59XG5cbi8vIFBSSU5UIEpTIE9OIFxue1xuICAgIHBFeGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIuaW1wcmltZXJcIilcbiAgICBpZiAocEV4aXN0KSB7XG4gICAgICAgIHdpbmRvdy5wcmludCgpXG4gICAgfVxufVxuLy8gUFJJTlQgSlMgT0ZGXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiU2lkZW5hdiIsImluaXRURSIsIkNvbGxhcHNlIiwiRHJvcGRvd24iLCIkIiwicmVxdWlyZSIsInNlbGVjdDIiLCJpbnB1dERhdGVEdWUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJhZGRFdmVudExpc3RlbmVyIiwiZXZlbnQiLCJpbnB1dEZpbHRyZUFzeW5jaHJvbmUiLCJpbnB1dENsaWVudCIsImlucHV0UHJvZHVpdERldHRlIiwiaW5wdXREYXRlRnJhaXMiLCJzZWxlY3RGcmFpc0ZpbHRyZSIsImlucHV0VXNlciIsImlucHV0UHJvZHVpdCIsInNlbGVjdEZpbHRyZVByb2R1aXQiLCJTZWxlY3RGaWx0cmVBc3luY2hyb25lIiwiaW5wdXRWZW50ZSIsImlucHV0Q2xpZW50VmVudGUiLCJpbnB1dFVzZXJ0VmVudGUiLCJpbnB1dENhaXNzZSIsInNlbGVjdFBvaW50IiwiaW5wdXRQcml4QWNoYXQiLCJpbnB1dFByaXhWZW50ZU1pbiIsImNvbnNvbGUiLCJsb2ciLCJ2YWx1ZSIsInBhcnNlRmxvYXQiLCJzZWxlY3QiLCJvcHRpb24iLCJ0YXJnZXQiLCJvcHRpb25zIiwic2VsZWN0ZWRJbmRleCIsInBhdGgiLCJnZXRBdHRyaWJ1dGUiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwidXJsIiwid2luZG93IiwibG9jYXRpb24iLCJocmVmIiwiZXJyIiwiaW5wdXQiLCJjb25jYXQiLCJpZCIsInBFeGlzdCIsInByaW50Il0sInNvdXJjZVJvb3QiOiIifQ==