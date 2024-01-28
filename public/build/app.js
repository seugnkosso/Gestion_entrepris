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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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Uy9CLHFCQUFxQkEsQ0FBQ0QsS0FBSyxFQUFDbUMsS0FBSyxFQUFDO0VBQ3ZDLElBQU1mLElBQUksTUFBQWdCLE1BQUEsQ0FBTUQsS0FBSyxDQUFDZCxZQUFZLENBQUMsV0FBVyxDQUFDLFdBQUFlLE1BQUEsQ0FBUUQsS0FBSyxDQUFDRSxFQUFFLE9BQUFELE1BQUEsQ0FBSUQsS0FBSyxDQUFDRyxLQUFLLENBQUU7RUFDaEZoQixLQUFLLENBQUNGLElBQUksRUFBQztJQUNQRyxNQUFNLEVBQUUsS0FBSztJQUNiQyxPQUFPLEVBQUU7TUFDVCxjQUFjLEVBQUU7SUFDaEI7RUFDQSxDQUFDLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLFVBQUFDLFFBQVE7SUFBQSxPQUFJQSxRQUFRLENBQUNDLElBQUksQ0FBQyxDQUFDO0VBQUEsRUFBQyxDQUNuQ0YsSUFBSSxDQUFDLFVBQUFHLEdBQUcsRUFBSTtJQUNiQyxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFDSCxHQUFHO0VBQ3hCLENBQUMsQ0FBQyxTQUNJLENBQUMsVUFBQUksR0FBRztJQUFBLE9BQUlDLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDRixHQUFHLENBQUM7RUFBQSxFQUFDO0FBQ3ZDOztBQUVBO0FBQ0E7RUFDSU8sTUFBTSxHQUFHMUMsUUFBUSxDQUFDQyxhQUFhLENBQUMsV0FBVyxDQUFDO0VBQzVDLElBQUl5QyxNQUFNLEVBQUU7SUFDUlYsTUFBTSxDQUFDVyxLQUFLLENBQUMsQ0FBQztFQUNsQjtBQUNKO0FBQ0E7Ozs7Ozs7Ozs7OztBQzNKQSIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3MiXSwic291cmNlc0NvbnRlbnQiOlsiLypcbiAqIFdlbGNvbWUgdG8geW91ciBhcHAncyBtYWluIEphdmFTY3JpcHQgZmlsZSFcbiAqXG4gKiBXZSByZWNvbW1lbmQgaW5jbHVkaW5nIHRoZSBidWlsdCB2ZXJzaW9uIG9mIHRoaXMgSmF2YVNjcmlwdCBmaWxlXG4gKiAoYW5kIGl0cyBDU1MgZmlsZSkgaW4geW91ciBiYXNlIGxheW91dCAoYmFzZS5odG1sLnR3aWcpLlxuICovXG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAndHctZWxlbWVudHMnO1xuaW1wb3J0ICcuL2pzL2FwcC5qcyc7XG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuXG4vLyBOQVZCQVIgSlMgT04gXG5pbXBvcnQge1xuICAgIFNpZGVuYXYsXG4gICAgaW5pdFRFLFxuICB9IGZyb20gXCJ0dy1lbGVtZW50c1wiO1xuICBcbiAgaW5pdFRFKHsgU2lkZW5hdiB9KTtcbiAgXG4gIGltcG9ydCB7XG4gICAgQ29sbGFwc2UsXG4gICAgRHJvcGRvd25cbiAgfSBmcm9tIFwidHctZWxlbWVudHNcIjtcbiAgXG4gIGluaXRURSh7IENvbGxhcHNlLCBEcm9wZG93biB9KTtcbiAgLy8gTkFWQkFSIEpTIE9GRlxuXG4vLyAvLyBTRUxFQ1QgMiBKUyBPTlxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcbnJlcXVpcmUoJ3NlbGVjdDInKVxuJCgnLnNlbGVjdDInKS5zZWxlY3QyKCk7XG4vLyAvLyBTRUxFQ1QgMiBKUyBPRkZcblxuXG5cblxuIiwiXG5cbi8vIERVRSBERVRURSBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dERhdGVEdWUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlLWR1ZScpO1xuICAgIGlmKGlucHV0RGF0ZUR1ZSl7XG4gICAgICAgIGlucHV0RGF0ZUR1ZS5hZGRFdmVudExpc3RlbmVyKFwiY2hhbmdlXCIsKGV2ZW50KT0+e1xuICAgICAgICAgICAgaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0RGF0ZUR1ZSk7XG4gICAgICAgIH0pXG4gICAgfSAgICBcbiAgICBcbiAgICBjb25zdCBpbnB1dENsaWVudCA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2NsaWVudCcpO1xuICAgIGlmKGlucHV0Q2xpZW50KXtcbiAgICAgICAgaW5wdXRDbGllbnQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dENsaWVudCk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxuICAgIFxuICAgIGNvbnN0IGlucHV0UHJvZHVpdERldHRlID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjcHJvZHVpdF9EZXR0ZScpO1xuICAgIGlmKGlucHV0UHJvZHVpdERldHRlKXtcbiAgICAgICAgaW5wdXRQcm9kdWl0RGV0dGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFByb2R1aXREZXR0ZSk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gRFVFIERFVFRFIEpTIE9GRlxuXG4vLyBGUkFJUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dERhdGVGcmFpcyA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGUtZnJhaXMnKTtcbiAgICBpZihpbnB1dERhdGVGcmFpcyl7XG4gICAgICAgIGlucHV0RGF0ZUZyYWlzLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXREYXRlRnJhaXMpO1xuICAgICAgICB9KVxuICAgIH0gICBcbiAgICBcbiAgICBjb25zdCBzZWxlY3RGcmFpc0ZpbHRyZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2RhdGVKci1mcmFpcycpO1xuICAgIGlmKHNlbGVjdEZyYWlzRmlsdHJlKXtcbiAgICAgICAgc2VsZWN0RnJhaXNGaWx0cmUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxzZWxlY3RGcmFpc0ZpbHRyZSk7XG4gICAgICAgIH0pXG4gICAgfSAgIFxufVxuLy8gRlJBSVMgSlMgT0ZGXG5cbi8vIFVTRVJTIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0VXNlciA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3VzZXInKTtcbiAgICBpZihpbnB1dFVzZXIpe1xuICAgICAgICBpbnB1dFVzZXIuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFVzZXIpO1xuICAgICAgICB9KVxuICAgIH0gICBcbn1cbi8vIFVTRVJTIEpTIE9GRlxuXG4vLyBQUk9EVUlUUyBKUyBPTiBcbntcbiAgICBjb25zdCBpbnB1dFByb2R1aXQgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcm9kdWl0Jyk7XG4gICAgaWYoaW5wdXRQcm9kdWl0KXtcbiAgICAgICAgaW5wdXRQcm9kdWl0LmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRQcm9kdWl0KTtcbiAgICAgICAgfSlcbiAgICB9ICAgXG5cbiAgICBjb25zdCBzZWxlY3RGaWx0cmVQcm9kdWl0ID1kb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjc2VsZWN0LWZpbHRyZS1Qcm9kdWl0Jyk7XG4gICAgaWYoc2VsZWN0RmlsdHJlUHJvZHVpdCl7XG4gICAgICAgIHNlbGVjdEZpbHRyZVByb2R1aXQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIFNlbGVjdEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsc2VsZWN0RmlsdHJlUHJvZHVpdCk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gUFJPRFVJVFMgSlMgT0ZGXG5cbi8vIFZFTlRFIENPTU1BTkRFIEpTIE9OIFxue1xuICAgIGNvbnN0IGlucHV0VmVudGUgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlLXZlbnRlJyk7XG4gICAgaWYoaW5wdXRWZW50ZSl7XG4gICAgICAgIGlucHV0VmVudGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFZlbnRlKTtcbiAgICAgICAgfSlcbiAgICB9XG4gICAgY29uc3QgaW5wdXRDbGllbnRWZW50ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI2NsaWVudF92ZW50ZScpO1xuICAgIGlmKGlucHV0Q2xpZW50VmVudGUpe1xuICAgICAgICBpbnB1dENsaWVudFZlbnRlLmFkZEV2ZW50TGlzdGVuZXIoXCJjaGFuZ2VcIiwoZXZlbnQpPT57XG4gICAgICAgICAgICBpbnB1dEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsaW5wdXRDbGllbnRWZW50ZSk7XG4gICAgICAgIH0pXG4gICAgfVxuICAgIGNvbnN0IGlucHV0VXNlcnRWZW50ZSA9ZG9jdW1lbnQucXVlcnlTZWxlY3RvcignI3VzZXJfdmVudGUnKTtcbiAgICBpZihpbnB1dFVzZXJ0VmVudGUpe1xuICAgICAgICBpbnB1dFVzZXJ0VmVudGUuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dFVzZXJ0VmVudGUpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIFZFTlRFIENPTU1BTkRFIEpTIE9GRlxuXG4vLyBDQUlTU0UgSlMgT04gXG57XG4gICAgY29uc3QgaW5wdXRDYWlzc2UgPWRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNkYXRlX2NhaXNzZScpO1xuICAgIGlmKGlucHV0Q2Fpc3NlKXtcbiAgICAgICAgaW5wdXRDYWlzc2UuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIGlucHV0RmlsdHJlQXN5bmNocm9uZShldmVudCxpbnB1dENhaXNzZSk7XG4gICAgICAgIH0pXG4gICAgfVxufVxuLy8gQ0FJU1NFIEpTIE9GRlxuXG4vLyBQT0lOVCBKUyBPTiBcbntcbiAgICBjb25zdCBzZWxlY3RQb2ludCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNzZWxlY3RQb2ludCcpO1xuICAgIGlmKHNlbGVjdFBvaW50KXtcbiAgICAgICAgc2VsZWN0UG9pbnQuYWRkRXZlbnRMaXN0ZW5lcihcImNoYW5nZVwiLChldmVudCk9PntcbiAgICAgICAgICAgIFNlbGVjdEZpbHRyZUFzeW5jaHJvbmUoZXZlbnQsc2VsZWN0UG9pbnQpO1xuICAgICAgICB9KVxuICAgIH1cbn1cbi8vIFBPSU5UIEpTIE9OIFxuXG5mdW5jdGlvbiBTZWxlY3RGaWx0cmVBc3luY2hyb25lKGV2ZW50LHNlbGVjdCl7XG4gICAgY29uc3Qgb3B0aW9uPWV2ZW50LnRhcmdldC5vcHRpb25zW3NlbGVjdC5zZWxlY3RlZEluZGV4XTtcbiAgICBjb25zdCBwYXRoPW9wdGlvbi5nZXRBdHRyaWJ1dGUoJ2RhdGEtcGF0aCcpICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICBtZXRob2Q6ICdHRVQnLFxuICAgIGhlYWRlcnM6IHtcbiAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgfVxuICAgIH0pLnRoZW4ocmVzcG9uc2UgPT4gcmVzcG9uc2UuanNvbigpKVxuICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICB9KVxuICAgIC5jYXRjaChlcnIgPT4gY29uc29sZS5sb2coZXJyKSlcbn1cblxuZnVuY3Rpb24gaW5wdXRGaWx0cmVBc3luY2hyb25lKGV2ZW50LGlucHV0KXtcbiAgICBjb25zdCBwYXRoID0gYCR7aW5wdXQuZ2V0QXR0cmlidXRlKCdkYXRhLXBhdGgnKX0/YXR0ciR7aW5wdXQuaWR9PSR7aW5wdXQudmFsdWV9YCAgICAgICBcbiAgICBmZXRjaChwYXRoLHtcbiAgICAgICAgbWV0aG9kOiAnR0VUJyxcbiAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgICAgIH1cbiAgICAgICAgfSkudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS5qc29uKCkpXG4gICAgICAgIC50aGVuKHVybCA9PiB7XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbi5ocmVmPXVybDtcbiAgICAgICAgfSlcbiAgICAgICAgLmNhdGNoKGVyciA9PiBjb25zb2xlLmxvZyhlcnIpKSAgXG59XG5cbi8vIFBSSU5UIEpTIE9OIFxue1xuICAgIHBFeGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIuaW1wcmltZXJcIilcbiAgICBpZiAocEV4aXN0KSB7XG4gICAgICAgIHdpbmRvdy5wcmludCgpXG4gICAgfVxufVxuLy8gUFJJTlQgSlMgT0ZGXG4iLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiU2lkZW5hdiIsImluaXRURSIsIkNvbGxhcHNlIiwiRHJvcGRvd24iLCIkIiwicmVxdWlyZSIsInNlbGVjdDIiLCJpbnB1dERhdGVEdWUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJhZGRFdmVudExpc3RlbmVyIiwiZXZlbnQiLCJpbnB1dEZpbHRyZUFzeW5jaHJvbmUiLCJpbnB1dENsaWVudCIsImlucHV0UHJvZHVpdERldHRlIiwiaW5wdXREYXRlRnJhaXMiLCJzZWxlY3RGcmFpc0ZpbHRyZSIsImlucHV0VXNlciIsImlucHV0UHJvZHVpdCIsInNlbGVjdEZpbHRyZVByb2R1aXQiLCJTZWxlY3RGaWx0cmVBc3luY2hyb25lIiwiaW5wdXRWZW50ZSIsImlucHV0Q2xpZW50VmVudGUiLCJpbnB1dFVzZXJ0VmVudGUiLCJpbnB1dENhaXNzZSIsInNlbGVjdFBvaW50Iiwic2VsZWN0Iiwib3B0aW9uIiwidGFyZ2V0Iiwib3B0aW9ucyIsInNlbGVjdGVkSW5kZXgiLCJwYXRoIiwiZ2V0QXR0cmlidXRlIiwiZmV0Y2giLCJtZXRob2QiLCJoZWFkZXJzIiwidGhlbiIsInJlc3BvbnNlIiwianNvbiIsInVybCIsIndpbmRvdyIsImxvY2F0aW9uIiwiaHJlZiIsImVyciIsImNvbnNvbGUiLCJsb2ciLCJpbnB1dCIsImNvbmNhdCIsImlkIiwidmFsdWUiLCJwRXhpc3QiLCJwcmludCJdLCJzb3VyY2VSb290IjoiIn0=