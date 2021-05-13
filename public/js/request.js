/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/request/request.js":
/*!*****************************************!*\
  !*** ./resources/js/request/request.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  var form = $('#request form');
  var specialties = [];
  form.on('submit', function (e) {
    e.preventDefault();
    $('#loader').fadeIn(100);
    $('#loader').append('<div class="ajax_loader"></div>');
    $('#loader').children('.ajax_loader').fadeIn(200);
    var data = new FormData(this);
    $('#request form .select').each(function (key, element) {
      data.append($(this).attr('id'), $(this).data('value'));
    });
    data.append('speciality_id', JSON.stringify(specialties));
    $.ajax({
      type: "POST",
      url: '/ajax/request/push',
      enctype: 'multipart/form-data',
      data: data,
      processData: false,
      contentType: false,
      success: function success(data) {
        if (data.redirect == true) window.location.replace(data.redirect_url);else {
          $('body').html(data.view);
          $('#loader').fadeOut(100);
        }
      },
      error: function error(response) {
        var data = response.responseJSON.errors;
        $('#loader').children('.ajax_loader').fadeOut(200);
        setTimeout(function () {
          $('#loader').children('.ajax_loader').remove();
        }, 500);
        show_message(data);
      }
    });
    return false;
  });
  $('#request form input[name="date_born"]').focusout(function () {
    if ($(this).val().length == 10) {
      var date = $(this).val().split('.');
      var today = new Date();
      var birthDate = new Date(date[2], date[1], date[0]);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || m === 0 && today.getDate() < birthDate.getDate()) age--;
      if (age < 18) $('#consent .download').attr('href', '/download/consent/consent.pdf');else $('#consent .download').attr('href', '/download/consent/consent18.pdf');
      $('#consent').css('display', 'flex').hide().fadeIn(200);
    } else $('#consent').css('display', 'flex').hide().fadeOut(200);
  });
  $('#request form input[name="date_born"]').mask('00.00.0000', {
    clearIfNotMatch: true
  });
  $('#request form input[name="passport_date"]').mask('00.00.0000', {
    clearIfNotMatch: true
  });
  $('#request form input[name="passport"]').mask('0000 000000', {
    clearIfNotMatch: true
  });
  $('#request form input[name="education_ending"]').mask('0000', {
    clearIfNotMatch: true
  });
  $('#request form input[name="education"]').mask('000000 0000000', {
    clearIfNotMatch: true
  });
  $('#request form input[name="phone"]').mask('8 000 000 - 00 - 00', {
    clearIfNotMatch: true
  });
  $('#request form .code .input').keyup(function () {
    if ($(this).is(':last-child') && this.value.length == this.maxLength) {
      $(this).blur();
    } else if (this.value.length == this.maxLength) {
      $(this).next('.input').focus();
    } else $(this).prev('.input').focus();
  });
  $(document).on('click', '#request form .select_button', function (e) {
    e.stopPropagation();

    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      specialties.splice(specialties.indexOf($(this).data('value')), 1);
    } else {
      $(this).addClass('active');
      specialties.push($(this).data('value'));
      $(this).closest('.specialties').data('value', specialties);
    }

    if (specialties.length == 0) {
      $(this).closest('.specialties').attr('data-input', false);
      $('form input[type="submit"]').attr('disabled', 'disabled');
    } else {
      $(this).closest('.specialties').attr('data-input', true);
      $('form input[type="submit"]').removeAttr('disabled');
    }
  });

  timer_click = function timer_click(url) {
    $.get(url).done(function () {
      $('#request form .timer_button').css('display', 'none');
      $('#request form .timer_block').fadeIn(200);

      var seconds = 60,
          _int = setInterval(function () {
        if (seconds > 0) {
          seconds--;
          $('#request form .timer_block .time').text(seconds);
        } else {
          clearInterval(_int);
          $('#request form .timer_block').css('display', 'none');
          $('#request form .timer_button').fadeIn(200);
        }
      }, 1000);
    });
  };
});

/***/ }),

/***/ 1:
/*!***********************************************!*\
  !*** multi ./resources/js/request/request.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/kostya/sites/khpk/resources/js/request/request.js */"./resources/js/request/request.js");


/***/ })

/******/ });