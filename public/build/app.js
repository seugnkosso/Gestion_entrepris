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

// SECTEUR JS ON 
{
  var selectFiltreChef = document.querySelector('#select-filtre-chef');
  if (selectFiltreChef) {
    selectFiltreChef.addEventListener("change", function (event) {
      SelectFiltreAsynchrone(event, selectFiltreChef);
    });
  }
  var selectFiltreDirection = document.querySelector('#select-filtre-direction');
  if (selectFiltreDirection) {
    selectFiltreDirection.addEventListener("change", function (event) {
      SelectFiltreAsynchrone(event, selectFiltreDirection);
    });
  }
}
// SECTEUR JS OFF
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
/******/ __webpack_require__.O(0, ["vendors-node_modules_select2_dist_js_select2_js-node_modules_select2_dist_css_select2_css-nod-fed336"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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IjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuY3NzPzZiZTYiXSwic291cmNlc0NvbnRlbnQiOlsiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAndHctZWxlbWVudHMnO1xuaW1wb3J0ICcuL2pzL2FwcC5qcyc7XG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuXG4vLyBOQVZCQVIgSlMgT04gXG5pbXBvcnQge1xuICAgIFNpZGVuYXYsXG4gICAgaW5pdFRFLFxuICB9IGZyb20gXCJ0dy1lbGVtZW50c1wiO1xuICBcbiAgaW5pdFRFKHsgU2lkZW5hdiB9KTtcbiAgXG4gIGltcG9ydCB7XG4gICAgQ29sbGFwc2UsXG4gICAgRHJvcGRvd25cbiAgfSBmcm9tIFwidHctZWxlbWVudHNcIjtcbiAgXG4gIGluaXRURSh7IENvbGxhcHNlLCBEcm9wZG93biB9KTtcbiAgLy8gTkFWQkFSIEpTIE9GRlxuXG4vLyAvLyBTRUxFQ1QgMiBKUyBPTlxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcbnJlcXVpcmUoJ3NlbGVjdDInKVxuJCgnLnNlbGVjdDInKS5zZWxlY3QyKCk7XG4vLyAvLyBTRUxFQ1QgMiBKUyBPRkZcblxuXG5cblxuIiwiXG5cbi8vIERVRSBERVRURSBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dERhdGVEdWUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlLWR1ZScpO1xuICAgIGlmKGlucHV0RGF0ZUR1ZSl7XG4gICAgICAgIGlucHV0RGF0ZUR1ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0RGF0ZUR1ZSk7XG4gICAgICAgIH0pXG4gICAgfSAgICBcbiAgICBcbiAgICBjb25zdCBpbnB1dENsaWVudCA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2NsaWVudCcpO1xuICAgIGlmKGlucHV0Q2xpZW50KXtcbiAgICAgICAgaW5wdXRDbGllbnQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dENsaWVudCk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxuICAgIFxuICAgIGNvbnN0IGlucHV0UHJvZHVpdERldHRlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjcHJvZHVpdF9EZXR0ZScpO1xuICAgIGlmKGlucHV0UHJvZHVpdERldHRlKXtcbiAgICAgICAgaW5wdXRQcm9kdWl0RGV0dGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFByb2R1aXREZXR0ZSk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gRFVFIERFVFRFIEpTIE9GRlxuXG4vLyBGUkFJUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dERhdGVGcmFpcyA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGUtZnJhaXMnKTtcbiAgICBpZihpbnB1dERhdGVGcmFpcyl7XG4gICAgICAgIGlucHV0RGF0ZUZyYWlzLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXREYXRlRnJhaXMpO1xuICAgICAgICB9KVxuICAgIH0gICBcbiAgICBcbiAgICBjb25zdCBzZWxlY3RGcmFpc0ZpbHRyZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGVKci1mcmFpcycpO1xuICAgIGlmKHNlbGVjdEZyYWlzRmlsdHJlKXtcbiAgICAgICAgc2VsZWN0RnJhaXNGaWx0cmUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3RGcmFpc0ZpbHRyZSk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxufVxuLy8gRlJBSVMgSlMgT0ZGXG5cbi8vIFVTRVJTIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0VXNlciA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3VzZXInKTtcbiAgICBpZihpbnB1dFVzZXIpe1xuICAgICAgICBpbnB1dFVzZXIuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFVzZXIpO1xuICAgICAgICB9KVxuICAgIH0gICBcbn1cbi8vIFVTRVJTIEpTIE9GRlxuXG4vLyBQUk9EVUlUUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dFByb2R1aXQgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcm9kdWl0Jyk7XG4gICAgaWYoaW5wdXRQcm9kdWl0KXtcbiAgICAgICAgaW5wdXRQcm9kdWl0LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRQcm9kdWl0KTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG5cbiAgICBjb25zdCBzZWxlY3RGaWx0cmVQcm9kdWl0ID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjc2VsZWN0LWZpbHRyZS1Qcm9kdWl0Jyk7XG4gICAgaWYoc2VsZWN0RmlsdHJlUHJvZHVpdCl7XG4gICAgICAgIHNlbGVjdEZpbHRyZVByb2R1aXQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIFNlbGVjdEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsc2VsZWN0RmlsdHJlUHJvZHVpdCk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gUFJPRFVJVFMgSlMgT0ZGXG5cbi8vIFZFTlRFIENPTU1BTkRFIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0VmVudGUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlLXZlbnRlJyk7XG4gICAgaWYoaW5wdXRWZW50ZSl7XG4gICAgICAgIGlucHV0VmVudGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFZlbnRlKTtcbiAgICAgICAgfSlcbiAgICB9XG4gICAgY29uc3QgaW5wdXRDbGllbnRWZW50ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2NsaWVudF92ZW50ZScpO1xuICAgIGlmKGlucHV0Q2xpZW50VmVudGUpe1xuICAgICAgICBpbnB1dENsaWVudFZlbnRlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRDbGllbnRWZW50ZSk7XG4gICAgICAgIH0pXG4gICAgfVxuICAgIGNvbnN0IGlucHV0VXNlcnRWZW50ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3VzZXJfdmVudGUnKTtcbiAgICBpZihpbnB1dFVzZXJ0VmVudGUpe1xuICAgICAgICBpbnB1dFVzZXJ0VmVudGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFVzZXJ0VmVudGUpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIFZFTlRFIENPTU1BTkRFIEpTIE9GRlxuXG4vLyBDQUlTU0UgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRDYWlzc2UgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlX2NhaXNzZScpO1xuICAgIGlmKGlucHV0Q2Fpc3NlKXtcbiAgICAgICAgaW5wdXRDYWlzc2UuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dENhaXNzZSk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gQ0FJU1NFIEpTIE9GRlxuXG5cblxuLy8gU0VDVEVVUiBKUyBPTiBcbnsgICAgXG4gICAgY29uc3Qgc2VsZWN0RmlsdHJlQ2hlZiA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3NlbGVjdC1maWx0cmUtY2hlZicpO1xuICAgIGlmKHNlbGVjdEZpbHRyZUNoZWYpe1xuICAgICAgICBzZWxlY3RGaWx0cmVDaGVmLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdEZpbHRyZUNoZWYpO1xuICAgICAgICB9KVxuICAgIH1cbiAgICBcbiAgICBjb25zdCBzZWxlY3RGaWx0cmVEaXJlY3Rpb24gPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNzZWxlY3QtZmlsdHJlLWRpcmVjdGlvbicpO1xuICAgIGlmKHNlbGVjdEZpbHRyZURpcmVjdGlvbil7XG4gICAgICAgIHNlbGVjdEZpbHRyZURpcmVjdGlvbi5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgU2VsZWN0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3RGaWx0cmVEaXJlY3Rpb24pO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIFNFQ1RFVVIgSlMgT0ZGXG5mdW5jdGlvbiBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdCl7XG4gICAgY29uc3Qgb3B0aW9uPWV2ZW50LnRhcmdldC5vcHRpb25zW3NlbGVjdC5zZWxlY3RlZEluZGV4XTtcbiAgICBjb25zdCBwYXRoPW9wdGlvbi5nZXRBdHRyaWJ1dGUoJ2RhdGEtcGF0aCcpICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICBtZXRob2Q6ICdHRVQnLFxuICAgIGhlYWRlcnM6IHtcbiAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgfVxuICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4gcmVzcG9uc2UuanNvbigpKVxuICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICB9KVxuICAgIC5jYXRjaChlcnIgPT4gY29uc29sZS5sb2coZXJyKSlcbn1cblxuZnVuY3Rpb24gaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0KXtcbiAgICBjb25zdCBwYXRoID0gYCR7aW5wdXQuZ2V0QXR0cmlidXRlKCdkYXRhLXBhdGgnKX0/YXR0ciR7aW5wdXQuaWR9PSR7aW5wdXQudmFsdWV9YCAgICAgICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICAgICAgbWV0aG9kOiAnR0VUJyxcbiAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgICAgIH1cbiAgICAgICAgfSkudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS5qc29uKCkpXG4gICAgICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICAgICAgfSlcbiAgICAgICAgLmNhdGNoKGVyciA9PiBjb25zb2xlLmxvZyhlcnIpKSAgXG59XG5cbi8vIFBSSU5UIEpTIE9OIFxue1xuICAgIHBFeGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIuaW1wcmltZXJcIilcbiAgICBpZiAocEV4aXN0KSB7XG4gICAgICAgIHdpbmRvdy5wcmludCgpXG4gICAgfVxufVxuLy8gUFJJTlQgSlMgT0ZGXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiU2lkZW5hdiIsImluaXRURSIsIkNvbGxhcHNlIiwiRHJvcGRvd24iLCIkIiwicmVxdWlyZSIsInNlbGVjdDIiLCJpbnB1dERhdGVEdWUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJhZGRFdmVudExpc3RlbmVyIiwiZXZlbnQiLCJpbnB1dEZpbHRyZUFzeW5jaHJvbmUiLCJpbnB1dENsaWVudCIsImlucHV0UHJvZHVpdERldHRlIiwiaW5wdXREYXRlRnJhaXMiLCJzZWxlY3RGcmFpc0ZpbHRyZSIsImlucHV0VXNlciIsImlucHV0UHJvZHVpdCIsInNlbGVjdEZpbHRyZVByb2R1aXQiLCJTZWxlY3RGaWx0cmVBc3luY2hyb25lIiwiaW5wdXRWZW50ZSIsImlucHV0Q2xpZW50VmVudGUiLCJpbnB1dFVzZXJ0VmVudGUiLCJpbnB1dENhaXNzZSIsInNlbGVjdEZpbHRyZUNoZWYiLCJzZWxlY3RGaWx0cmVEaXJlY3Rpb24iLCJzZWxlY3QiLCJvcHRpb24iLCJ0YXJnZXQiLCJvcHRpb25zIiwic2VsZWN0ZWRJbmRleCIsInBhdGgiLCJnZXRBdHRyaWJ1dGUiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwidXJsIiwid2luZG93IiwibG9jYXRpb24iLCJocmVmIiwiZXJyIiwiY29uc29sZSIsImxvZyIsImlucHV0IiwiY29uY2F0IiwiaWQiLCJ2YWx1ZSIsInBFeGlzdCIsInByaW50Il0sInNvdXJjZVJvb3QiOiIifQ==