/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import 'tw-elements';
import './js/app.js';
import './styles/app.css';

// NAVBAR JS ON 
import {
    Sidenav,
    initTE,
  } from "tw-elements";
  
  initTE({ Sidenav });
  
  import {
    Collapse,
    Dropdown
  } from "tw-elements";
  
  initTE({ Collapse, Dropdown });
  // NAVBAR JS OFF

// // SELECT 2 JS ON
import $ from 'jquery';
require('select2')
$('.select2').select2();
// // SELECT 2 JS OFF




