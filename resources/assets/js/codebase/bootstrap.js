/*
 *  Document   : bootstrap.js
 *  Author     : pixelcave
 *  Description: Import global dependencies
 *
 */

// Import all vital core JS files..
import jQuery from 'jquery';
import SimpleBar from 'simplebar';
import Cookies from 'js-cookie';
import 'bootstrap';
import 'popper.js';
import 'jquery.appear';
import 'jquery-scroll-lock';
import 'jquery-countto';
import "select2";
import "select2/dist/css/select2.css";

// ..and assign to window the ones that need it
window.$ = window.jQuery = jQuery;
window.SimpleBar = SimpleBar;
window.Cookies = Cookies;
window.jqueryvalidation = require("jquery-validation");
require("summernote");
require("summernote/dist/summernote.css");
