@extends('layouts.index')
@section('css')
<style>
    * {
        font-family: 'Noto Sans', sans-serif;
        font-style: 500;
    }
    .navbar-header {
        height: 50px;
    }
    .logo {
        line-height: 50px;
    }
    .header-item {
        height: 50px;
    }
    .vertical-menu {
        width: 200px;
        margin-top: 50px;
    }
    body[data-sidebar-size="sm"] .vertical-menu {
        position: absolute;
        width: 200px;
        margin-top: 50px;
        z-index: 1001;
    }
    .navbar-brand-box {
        padding: 0 0.5rem;
        width: 200px;
    }
    .main-content {
        margin-left: 190px;
        overflow: hidden;
    }
    body[data-sidebar-size="sm"] .main-content {
        margin-left: 40px;
        /* margin-left: 60px; */
    }
    #page-topbar {
        left: 200px;
        left: 0px;
        z-index: 1004;
    }
    body[data-sidebar-size="sm"] #page-topbar {
        left: 0px;
    }
    .icon-sm {
        height: 17px;
        width: 17px;
    }
    .vertical-menu .vertical-menu-btn {
        position: absolute;
        right: -35px;
        top: -15px;
        z-index: 2;
    }
    body:not([data-sidebar-size="lg"]) .navbar-header .vertical-menu-btn {
        display: none;
    }
    body[data-sidebar-size="sm"] .vertical-menu .vertical-menu-btn {
        display: block !important;
        display: block !important;
        padding: 0;
        height: 22px;
        width: 30px;
        z-index: 0;
    }
    .badge-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
        }
    }
    body[data-sidebar-size="lg"] .vertical-menu .vertical-menu-btn {
        display: block !important;
        display: block !important;
        padding: 0;
        height: 22px;
        width: 37px;
    }
    .vertical-menu .vertical-menu-btn {
        position: absolute;
        right: -21px;
        top: 5px;
        z-index: 2;
    }
    .header-profile-user {
        height: 30px;
        width: 30px;
        border: 1px solid #e9ebed;
        padding: 3px;
    }
    .uil-angle-right-b {
        background-color: #19007c4a !important;
        border-radius: 0 5px 5px 0;
    }
    .page-content {
        padding: calc(60px + 20px) calc(20px / 2) 20px calc(20px / 2);
    }
    .sidebar-menu-scroll {
        height: calc(100% - 70px);
        margin-top: -10px;
    }
    body[data-sidebar-size="sm"] .vertical-menu {
        width: 55px !important;
    }
    body[data-sidebar-size="sm"] .vertical-menu #sidebar-menu>ul>li>a {
        padding: 7px;
        -webkit-transition: none;
        transition: none;
        display: block;
    }
    .metismenu {
        margin-top: 2px;
    }
    .modal-backdrop {
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        z-index: 1040 !important;
    }
</style>
<style>
    .my-tree li {
        position: relative;
        padding-left: 14px;
    }
    .my-tree li::before {
        content: "";
        position: absolute;
        left: 6px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    .my-tree .click {
        cursor: pointer;
    }
</style>
<style>
    .scrollable-list {
        max-height: 200px;
        overflow-y: auto;
    }
    #favoriteProjectsList li {
        padding: 10px;
    }
    .remove-from-favorites {
        cursor: pointer;
        margin-right: 5px;
    }
    .remove-from-favorites i {
        font-size: 16px;
    }
    .project-link {
        color: inherit;
        text-decoration: none;
        padding-left: 0.5rem;
    }
    .project-button i {
        color: inherit;
        text-decoration: none;
    }
    #toast-container {
        top: 20px !important;
        right: 20px !important;
        width: auto !important;
    }
    .toast {
        background: #fff !important;
        color: #333 !important;
        padding: 15px 20px 15px 40px !important;
        border-radius: 10px !important;
        min-width: 300px !important;
        max-width: 350px !important;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15) !important;
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 14px !important;
        border-left: 6px solid transparent !important;
        opacity: 1 !important;
    }
    .toast-title {
        font-size: 16px !important;
        font-weight: bold;
    }
    .toast-message {
        font-size: 14px !important;
        margin-top: 5px;
    }
    .toast-close-button {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        font-size: 18px !important;
        color: #777 !important;
    }
    .toast-info {
        border-left-color: #0070e0 !important;
    }
    .toast-success {
        border-left-color: #03a65a !important;
    }
    .toast-warning {
        border-left-color: #fc8621 !important;
    }
    .toast-error {
        border-left-color: #db3056 !important;
    }
    .toast-message a {
        color: inherit !important;
        font-weight: bold;
        text-decoration: none;
    }
    .toast-message a:hover {
        text-decoration: underline;
    }
    #toast-container {
        top: 60px !important;
        right: 20px !important;
        width: auto !important;
    }
    .toast {
        background: #fff !important;
        color: #333 !important;
        padding: 15px 20px 15px 20px !important;
        border-radius: 10px !important;
        min-width: 350px !important;
        max-width: 350px !important;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15) !important;
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 14px !important;
        border-left: 6px solid transparent !important;
        opacity: 1 !important;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .toast.fadeOut {
        opacity: 0 !important;
        transform: translateY(-10px) scale(0.95) !important;
    }
    .toast-title {
        font-size: 16px !important;
        font-weight: bold;
    }
    .toast-message {
        font-size: 14px !important;
        margin-top: 5px;
    }
    .toast-close-button {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        font-size: 18px !important;
        color: #777 !important;
    }
    .toast-close-button:hover {
        color: #000 !important;
    }
    .toast-info {
        border-left-color: #0070e0 !important;
    }
    .toast-success {
        border-left-color: #03a65a !important;
    }
    .toast-warning {
        border-left-color: #fc8621 !important;
    }
    .toast-error {
        border-left-color: #db3056 !important;
    }
    .toast-message a {
        color: inherit !important;
        font-weight: bold;
        text-decoration: none;
    }
    .toast-message a:hover {
        text-decoration: underline;
    }
</style>
<style>
    .chosen-single,
    .chosen-choices {
        height: 35px !important;
        background: white !important;
        line-height: 30px !important;
    }
    .color-sample {
        visibility: visible !important;
    }
    .color-sample {
        width: 10px;
        height: 10px;
        display: inline-block;
        margin-right: 5px;
        border: 1px solid #000;
    }
    .chosen-container .chosen-results {
        overflow-y: hidden;
    }
    .wtree li {
        list-style-type: none;
        margin: 10px 0 10px 10px;
        position: relative;
    }
    .wtree li:before {
        content: "";
        position: absolute;
        top: -10px;
        left: -25px;
        border-left: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        width: 20px;
        height: 15px;
    }
    .wtree li:after {
        position: absolute;
        content: "";
        top: 5px;
        left: -25px;
        border-left: 1px solid #ddd;
        border-top: 1px solid #ddd;
        width: 20px;
        height: 100%;
    }
    .wtree li:last-child:after {
        display: none;
    }
    .wtree li span {
        display: block;
        border: 1px solid #ddd;
        padding: 10px;
        color: #888;
        text-decoration: none;
    }
    .wtree li span:hover,
    .wtree li span:focus {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }
    .wtree li span:hover+ul li span,
    .wtree li span:focus+ul li span {
        background: #eee;
        color: #000;
        border: 1px solid #aaa;
    }
    .wtree li span:hover+ul li:after,
    .wtree li span:focus+ul li:after,
    .wtree li span:hover+ul li:before,
    .wtree li span:focus+ul li:before {
        border-color: #aaa;
    }
    .wtree ul {
        display: none;
    }
</style>
<style>
    .swal2-popup.swal2-toast {
        box-sizing: border-box;
        grid-column: 1/4 !important;
        grid-row: 1/4 !important;
        grid-template-columns: min-content auto min-content;
        padding: 1em;
        overflow-y: hidden;
        background: #fff;
        box-shadow: 0 0 1px rgba(0, 0, 0, .075), 0 1px 2px rgba(0, 0, 0, .075), 1px 2px 4px rgba(0, 0, 0, .075), 1px 3px 8px rgba(0, 0, 0, .075), 2px 4px 16px rgba(0, 0, 0, .075);
        pointer-events: all
    }
    .swal2-popup.swal2-toast>* {
        grid-column: 2
    }
    .swal2-popup.swal2-toast .swal2-title {
        margin: .5em 1em;
        padding: 0;
        font-size: 1em;
        text-align: initial
    }
    .swal2-popup.swal2-toast .swal2-loading {
        justify-content: center
    }
    .swal2-popup.swal2-toast .swal2-input {
        height: 2em;
        margin: .5em;
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-validation-message {
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-footer {
        margin: .5em 0 0;
        padding: .5em 0 0;
        font-size: .8em
    }
    .swal2-popup.swal2-toast .swal2-close {
        grid-column: 3/3;
        grid-row: 1/99;
        align-self: center;
        width: .8em;
        height: .8em;
        margin: 0;
        font-size: 2em
    }
    .swal2-popup.swal2-toast .swal2-html-container {
        margin: .5em 1em;
        padding: 0;
        overflow: initial;
        font-size: 1em;
        text-align: initial
    }
    .swal2-popup.swal2-toast .swal2-html-container:empty {
        padding: 0
    }
    .swal2-popup.swal2-toast .swal2-loader {
        grid-column: 1;
        grid-row: 1/99;
        align-self: center;
        width: 2em;
        height: 2em;
        margin: .25em
    }
    .swal2-popup.swal2-toast .swal2-icon {
        grid-column: 1;
        grid-row: 1/99;
        align-self: center;
        width: 2em;
        min-width: 2em;
        height: 2em;
        margin: 0 .5em 0 0
    }
    .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
        display: flex;
        align-items: center;
        font-size: 1.8em;
        font-weight: bold
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
        width: 2em;
        height: 2em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
        top: .875em;
        width: 1.375em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left] {
        left: .3125em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
        right: .3125em
    }
    .swal2-popup.swal2-toast .swal2-actions {
        justify-content: flex-start;
        height: auto;
        margin: 0;
        margin-top: .5em;
        padding: 0 .5em
    }
    .swal2-popup.swal2-toast .swal2-styled {
        margin: .25em .5em;
        padding: .4em .6em;
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-success {
        border-color: #a5dc86
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line] {
        position: absolute;
        width: 1.6em;
        height: 3em;
        border-radius: 50%
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left] {
        top: -0.8em;
        left: -0.5em;
        transform: rotate(-45deg);
        transform-origin: 2em 2em;
        border-radius: 4em 0 0 4em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right] {
        top: -0.25em;
        left: .9375em;
        transform-origin: 0 1.5em;
        border-radius: 0 4em 4em 0
    }
    .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
        width: 2em;
        height: 2em
    }
    .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
        top: 0;
        left: .4375em;
        width: .4375em;
        height: 2.6875em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line] {
        height: .3125em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip] {
        top: 1.125em;
        left: .1875em;
        width: .75em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long] {
        top: .9375em;
        right: .1875em;
        width: 1.375em
    }
    .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip {
        animation: swal2-toast-animate-success-line-tip .75s
    }
    .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long {
        animation: swal2-toast-animate-success-line-long .75s
    }
    .swal2-popup.swal2-toast.swal2-show {
        animation: swal2-toast-show .5s
    }
    .swal2-popup.swal2-toast.swal2-hide {
        animation: swal2-toast-hide .1s forwards
    }
    div:where(.swal2-container) {
        display: grid;
        position: fixed;
        z-index: 1060;
        inset: 0;
        box-sizing: border-box;
        grid-template-areas: "top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";
        grid-template-rows: minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);
        height: 100%;
        padding: .625em;
        overflow-x: hidden;
        transition: background-color .1s;
        -webkit-overflow-scrolling: touch
    }
    div:where(.swal2-container).swal2-backdrop-show,
    div:where(.swal2-container).swal2-noanimation {
        background: rgba(0, 0, 0, .4)
    }
    div:where(.swal2-container).swal2-backdrop-hide {
        background: rgba(0, 0, 0, 0) !important
    }
    div:where(.swal2-container).swal2-top-start,
    div:where(.swal2-container).swal2-center-start,
    div:where(.swal2-container).swal2-bottom-start {
        grid-template-columns: minmax(0, 1fr) auto auto
    }
    div:where(.swal2-container).swal2-top,
    div:where(.swal2-container).swal2-center,
    div:where(.swal2-container).swal2-bottom {
        grid-template-columns: auto minmax(0, 1fr) auto
    }
    div:where(.swal2-container).swal2-top-end,
    div:where(.swal2-container).swal2-center-end,
    div:where(.swal2-container).swal2-bottom-end {
        grid-template-columns: auto auto minmax(0, 1fr)
    }
    div:where(.swal2-container).swal2-top-start>.swal2-popup {
        align-self: start
    }
    div:where(.swal2-container).swal2-top>.swal2-popup {
        grid-column: 2;
        place-self: start center
    }
    div:where(.swal2-container).swal2-top-end>.swal2-popup,
    div:where(.swal2-container).swal2-top-right>.swal2-popup {
        grid-column: 3;
        place-self: start end
    }
    div:where(.swal2-container).swal2-center-start>.swal2-popup,
    div:where(.swal2-container).swal2-center-left>.swal2-popup {
        grid-row: 2;
        align-self: center
    }
    div:where(.swal2-container).swal2-center>.swal2-popup {
        grid-column: 2;
        grid-row: 2;
        place-self: center center
    }
    div:where(.swal2-container).swal2-center-end>.swal2-popup,
    div:where(.swal2-container).swal2-center-right>.swal2-popup {
        grid-column: 3;
        grid-row: 2;
        place-self: center end
    }
    div:where(.swal2-container).swal2-bottom-start>.swal2-popup,
    div:where(.swal2-container).swal2-bottom-left>.swal2-popup {
        grid-column: 1;
        grid-row: 3;
        align-self: end
    }
    div:where(.swal2-container).swal2-bottom>.swal2-popup {
        grid-column: 2;
        grid-row: 3;
        place-self: end center
    }
    div:where(.swal2-container).swal2-bottom-end>.swal2-popup,
    div:where(.swal2-container).swal2-bottom-right>.swal2-popup {
        grid-column: 3;
        grid-row: 3;
        place-self: end end
    }
    div:where(.swal2-container).swal2-grow-row>.swal2-popup,
    div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
        grid-column: 1/4;
        width: 100%
    }
    div:where(.swal2-container).swal2-grow-column>.swal2-popup,
    div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
        grid-row: 1/4;
        align-self: stretch
    }
    div:where(.swal2-container).swal2-no-transition {
        transition: none !important
    }
    div:where(.swal2-container) div:where(.swal2-popup) {
        display: none;
        position: relative;
        box-sizing: border-box;
        grid-template-columns: minmax(0, 100%);
        width: 32em;
        max-width: 100%;
        padding: 0 0 1.25em;
        border: none;
        border-radius: 5px;
        background: #fff;
        color: #545454;
        font-family: inherit;
        font-size: 1rem
    }
    div:where(.swal2-container) div:where(.swal2-popup):focus {
        outline: none
    }
    div:where(.swal2-container) div:where(.swal2-popup).swal2-loading {
        overflow-y: hidden
    }
    div:where(.swal2-container) h2:where(.swal2-title) {
        position: relative;
        max-width: 100%;
        margin: 0;
        padding: .8em 1em 0;
        color: inherit;
        font-size: 1.875em;
        font-weight: 600;
        text-align: center;
        text-transform: none;
        word-wrap: break-word
    }
    div:where(.swal2-container) div:where(.swal2-actions) {
        display: flex;
        z-index: 1;
        box-sizing: border-box;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        width: auto;
        margin: 1.25em auto 0;
        padding: 0
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled] {
        opacity: .4
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover {
        background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active {
        background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))
    }
    div:where(.swal2-container) div:where(.swal2-loader) {
        display: none;
        align-items: center;
        justify-content: center;
        width: 2.2em;
        height: 2.2em;
        margin: 0 1.875em;
        animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
        border-width: .25em;
        border-style: solid;
        border-radius: 100%;
        border-color: #2778c4 rgba(0, 0, 0, 0) #2778c4 rgba(0, 0, 0, 0)
    }
    div:where(.swal2-container) button:where(.swal2-styled) {
        margin: .3125em;
        padding: .625em 1.1em;
        transition: box-shadow .1s;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0);
        font-weight: 500
    }
    div:where(.swal2-container) button:where(.swal2-styled):not([disabled]) {
        cursor: pointer
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #7066e0;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
        box-shadow: 0 0 0 3px rgba(112, 102, 224, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-deny {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #dc3741;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus {
        box-shadow: 0 0 0 3px rgba(220, 55, 65, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #6e7881;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus {
        box-shadow: 0 0 0 3px rgba(110, 120, 129, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
        box-shadow: 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled):focus {
        outline: none
    }
    div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner {
        border: 0
    }
    div:where(.swal2-container) div:where(.swal2-footer) {
        margin: 1em 0 0;
        padding: 1em 1em 0;
        border-top: 1px solid #eee;
        color: inherit;
        font-size: 1em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-timer-progress-bar-container {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        grid-column: auto !important;
        overflow: hidden;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px
    }
    div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
        width: 100%;
        height: .25em;
        background: rgba(0, 0, 0, .2)
    }
    div:where(.swal2-container) img:where(.swal2-image) {
        max-width: 100%;
        margin: 2em auto 1em
    }
    div:where(.swal2-container) button:where(.swal2-close) {
        z-index: 2;
        align-items: center;
        justify-content: center;
        width: 1.2em;
        height: 1.2em;
        margin-top: 0;
        margin-right: 0;
        margin-bottom: -1.2em;
        padding: 0;
        overflow: hidden;
        transition: color .1s, box-shadow .1s;
        border: none;
        border-radius: 5px;
        background: rgba(0, 0, 0, 0);
        color: #ccc;
        font-family: monospace;
        font-size: 2.5em;
        cursor: pointer;
        justify-self: end
    }
    div:where(.swal2-container) button:where(.swal2-close):hover {
        transform: none;
        background: rgba(0, 0, 0, 0);
        color: #f27474
    }
    div:where(.swal2-container) button:where(.swal2-close):focus {
        outline: none;
        box-shadow: inset 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner {
        border: 0
    }
    div:where(.swal2-container) .swal2-html-container {
        z-index: 1;
        justify-content: center;
        margin: 1em 1.6em .3em;
        padding: 0;
        overflow: auto;
        color: inherit;
        font-size: 1.125em;
        font-weight: normal;
        line-height: normal;
        text-align: center;
        word-wrap: break-word;
        word-break: break-word
    }
    div:where(.swal2-container) input:where(.swal2-input),
    div:where(.swal2-container) input:where(.swal2-file),
    div:where(.swal2-container) textarea:where(.swal2-textarea),
    div:where(.swal2-container) select:where(.swal2-select),
    div:where(.swal2-container) div:where(.swal2-radio),
    div:where(.swal2-container) label:where(.swal2-checkbox) {
        margin: 1em 2em 3px
    }
    div:where(.swal2-container) input:where(.swal2-input),
    div:where(.swal2-container) input:where(.swal2-file),
    div:where(.swal2-container) textarea:where(.swal2-textarea) {
        box-sizing: border-box;
        width: auto;
        transition: border-color .1s, box-shadow .1s;
        border: 1px solid #d9d9d9;
        border-radius: .1875em;
        background: rgba(0, 0, 0, 0);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
        color: inherit;
        font-size: 1.125em
    }
    div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,
    div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,
    div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror {
        border-color: #f27474 !important;
        box-shadow: 0 0 2px #f27474 !important
    }
    div:where(.swal2-container) input:where(.swal2-input):focus,
    div:where(.swal2-container) input:where(.swal2-file):focus,
    div:where(.swal2-container) textarea:where(.swal2-textarea):focus {
        border: 1px solid #b4dbed;
        outline: none;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) input:where(.swal2-input)::placeholder,
    div:where(.swal2-container) input:where(.swal2-file)::placeholder,
    div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder {
        color: #ccc
    }
    div:where(.swal2-container) .swal2-range {
        margin: 1em 2em 3px;
        background: #fff
    }
    div:where(.swal2-container) .swal2-range input {
        width: 80%
    }
    div:where(.swal2-container) .swal2-range output {
        width: 20%;
        color: inherit;
        font-weight: 600;
        text-align: center
    }
    div:where(.swal2-container) .swal2-range input,
    div:where(.swal2-container) .swal2-range output {
        height: 2.625em;
        padding: 0;
        font-size: 1.125em;
        line-height: 2.625em
    }
    div:where(.swal2-container) .swal2-input {
        height: 2.625em;
        padding: 0 .75em
    }
    div:where(.swal2-container) .swal2-file {
        width: 75%;
        margin-right: auto;
        margin-left: auto;
        background: rgba(0, 0, 0, 0);
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-textarea {
        height: 6.75em;
        padding: .75em
    }
    div:where(.swal2-container) .swal2-select {
        min-width: 50%;
        max-width: 100%;
        padding: .375em .625em;
        background: rgba(0, 0, 0, 0);
        color: inherit;
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-radio,
    div:where(.swal2-container) .swal2-checkbox {
        align-items: center;
        justify-content: center;
        background: #fff;
        color: inherit
    }
    div:where(.swal2-container) .swal2-radio label,
    div:where(.swal2-container) .swal2-checkbox label {
        margin: 0 .6em;
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-radio input,
    div:where(.swal2-container) .swal2-checkbox input {
        flex-shrink: 0;
        margin: 0 .4em
    }
    div:where(.swal2-container) label:where(.swal2-input-label) {
        display: flex;
        justify-content: center;
        margin: 1em auto 0
    }
    div:where(.swal2-container) div:where(.swal2-validation-message) {
        align-items: center;
        justify-content: center;
        margin: 1em 0 0;
        padding: .625em;
        overflow: hidden;
        background: #f0f0f0;
        color: #666;
        font-size: 1em;
        font-weight: 300
    }
    div:where(.swal2-container) div:where(.swal2-validation-message)::before {
        content: "!";
        display: inline-block;
        width: 1.5em;
        min-width: 1.5em;
        height: 1.5em;
        margin: 0 .625em;
        border-radius: 50%;
        background-color: #f27474;
        color: #fff;
        font-weight: 600;
        line-height: 1.5em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-progress-steps {
        flex-wrap: wrap;
        align-items: center;
        max-width: 100%;
        margin: 1.25em auto;
        padding: 0;
        background: rgba(0, 0, 0, 0);
        font-weight: 600
    }
    div:where(.swal2-container) .swal2-progress-steps li {
        display: inline-block;
        position: relative
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step {
        z-index: 20;
        flex-shrink: 0;
        width: 2em;
        height: 2em;
        border-radius: 2em;
        background: #2778c4;
        color: #fff;
        line-height: 2em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
        background: #2778c4
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step {
        background: #add8e6;
        color: #fff
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
        background: #add8e6
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line {
        z-index: 10;
        flex-shrink: 0;
        width: 2.5em;
        height: .4em;
        margin: 0 -1px;
        background: #2778c4
    }
    div:where(.swal2-icon) {
        position: relative;
        box-sizing: content-box;
        justify-content: center;
        width: 5em;
        height: 5em;
        margin: 2.5em auto .6em;
        border: 0.25em solid rgba(0, 0, 0, 0);
        border-radius: 50%;
        border-color: #000;
        font-family: inherit;
        line-height: 5em;
        cursor: default;
        user-select: none
    }
    div:where(.swal2-icon) .swal2-icon-content {
        display: flex;
        align-items: center;
        font-size: 3.75em
    }
    div:where(.swal2-icon).swal2-error {
        border-color: #f27474;
        color: #f27474
    }
    div:where(.swal2-icon).swal2-error .swal2-x-mark {
        position: relative;
        flex-grow: 1
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
        display: block;
        position: absolute;
        top: 2.3125em;
        width: 2.9375em;
        height: .3125em;
        border-radius: .125em;
        background-color: #f27474
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
        left: 1.0625em;
        transform: rotate(45deg)
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
        right: 1em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-error.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
        animation: swal2-animate-error-x-mark .5s
    }
    div:where(.swal2-icon).swal2-warning {
        border-color: #facea8;
        color: #f8bb86
    }
    div:where(.swal2-icon).swal2-warning.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-i-mark .5s
    }
    div:where(.swal2-icon).swal2-info {
        border-color: #9de0f6;
        color: #3fc3ee
    }
    div:where(.swal2-icon).swal2-info.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-i-mark .8s
    }
    div:where(.swal2-icon).swal2-question {
        border-color: #c9dae1;
        color: #87adbd
    }
    div:where(.swal2-icon).swal2-question.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-question-mark .8s
    }
    div:where(.swal2-icon).swal2-success {
        border-color: #a5dc86;
        color: #a5dc86
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line] {
        position: absolute;
        width: 3.75em;
        height: 7.5em;
        border-radius: 50%
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
        top: -0.4375em;
        left: -2.0635em;
        transform: rotate(-45deg);
        transform-origin: 3.75em 3.75em;
        border-radius: 7.5em 0 0 7.5em
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right] {
        top: -0.6875em;
        left: 1.875em;
        transform: rotate(-45deg);
        transform-origin: 0 3.75em;
        border-radius: 0 7.5em 7.5em 0
    }
    div:where(.swal2-icon).swal2-success .swal2-success-ring {
        position: absolute;
        z-index: 2;
        top: -0.25em;
        left: -0.25em;
        box-sizing: content-box;
        width: 100%;
        height: 100%;
        border: .25em solid rgba(165, 220, 134, .3);
        border-radius: 50%
    }
    div:where(.swal2-icon).swal2-success .swal2-success-fix {
        position: absolute;
        z-index: 1;
        top: .5em;
        left: 1.625em;
        width: .4375em;
        height: 5.625em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
        display: block;
        position: absolute;
        z-index: 2;
        height: .3125em;
        border-radius: .125em;
        background-color: #a5dc86
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip] {
        top: 2.875em;
        left: .8125em;
        width: 1.5625em;
        transform: rotate(45deg)
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long] {
        top: 2.375em;
        right: .5em;
        width: 2.9375em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
        animation: swal2-animate-success-line-tip .75s
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
        animation: swal2-animate-success-line-long .75s
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
        animation: swal2-rotate-success-circular-line 4.25s ease-in
    }
    [class^=swal2] {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
    }
    .swal2-show {
        animation: swal2-show .3s
    }
    .swal2-hide {
        animation: swal2-hide .15s forwards
    }
    .swal2-noanimation {
        transition: none
    }
    .swal2-scrollbar-measure {
        position: absolute;
        top: -9999px;
        width: 50px;
        height: 50px;
        overflow: scroll
    }
    .swal2-rtl .swal2-close {
        margin-right: initial;
        margin-left: 0
    }
    .swal2-rtl .swal2-timer-progress-bar {
        right: 0;
        left: auto
    }
    @keyframes swal2-toast-show {
        0% {
            transform: translateY(-0.625em) rotateZ(2deg)
        }
        33% {
            transform: translateY(0) rotateZ(-2deg)
        }
        66% {
            transform: translateY(0.3125em) rotateZ(2deg)
        }
        100% {
            transform: translateY(0) rotateZ(0deg)
        }
    }
    @keyframes swal2-toast-hide {
        100% {
            transform: rotateZ(1deg);
            opacity: 0
        }
    }
    @keyframes swal2-toast-animate-success-line-tip {
        0% {
            top: .5625em;
            left: .0625em;
            width: 0
        }
        54% {
            top: .125em;
            left: .125em;
            width: 0
        }
        70% {
            top: .625em;
            left: -0.25em;
            width: 1.625em
        }
        84% {
            top: 1.0625em;
            left: .75em;
            width: .5em
        }
        100% {
            top: 1.125em;
            left: .1875em;
            width: .75em
        }
    }
    @keyframes swal2-toast-animate-success-line-long {
        0% {
            top: 1.625em;
            right: 1.375em;
            width: 0
        }
        65% {
            top: 1.25em;
            right: .9375em;
            width: 0
        }
        84% {
            top: .9375em;
            right: 0;
            width: 1.125em
        }
        100% {
            top: .9375em;
            right: .1875em;
            width: 1.375em
        }
    }
    @keyframes swal2-show {
        0% {
            transform: scale(0.7)
        }
        45% {
            transform: scale(1.05)
        }
        80% {
            transform: scale(0.95)
        }
        100% {
            transform: scale(1)
        }
    }
    @keyframes swal2-hide {
        0% {
            transform: scale(1);
            opacity: 1
        }
        100% {
            transform: scale(0.5);
            opacity: 0
        }
    }
    @keyframes swal2-animate-success-line-tip {
        0% {
            top: 1.1875em;
            left: .0625em;
            width: 0
        }
        54% {
            top: 1.0625em;
            left: .125em;
            width: 0
        }
        70% {
            top: 2.1875em;
            left: -0.375em;
            width: 3.125em
        }
        84% {
            top: 3em;
            left: 1.3125em;
            width: 1.0625em
        }
        100% {
            top: 2.8125em;
            left: .8125em;
            width: 1.5625em
        }
    }
    @keyframes swal2-animate-success-line-long {
        0% {
            top: 3.375em;
            right: 2.875em;
            width: 0
        }
        65% {
            top: 3.375em;
            right: 2.875em;
            width: 0
        }
        84% {
            top: 2.1875em;
            right: 0;
            width: 3.4375em
        }
        100% {
            top: 2.375em;
            right: .5em;
            width: 2.9375em
        }
    }
    @keyframes swal2-rotate-success-circular-line {
        0% {
            transform: rotate(-45deg)
        }
        5% {
            transform: rotate(-45deg)
        }
        12% {
            transform: rotate(-405deg)
        }
        100% {
            transform: rotate(-405deg)
        }
    }
    @keyframes swal2-animate-error-x-mark {
        0% {
            margin-top: 1.625em;
            transform: scale(0.4);
            opacity: 0
        }
        50% {
            margin-top: 1.625em;
            transform: scale(0.4);
            opacity: 0
        }
        80% {
            margin-top: -0.375em;
            transform: scale(1.15)
        }
        100% {
            margin-top: 0;
            transform: scale(1);
            opacity: 1
        }
    }
    @keyframes swal2-animate-error-icon {
        0% {
            transform: rotateX(100deg);
            opacity: 0
        }
        100% {
            transform: rotateX(0deg);
            opacity: 1
        }
    }
    @keyframes swal2-rotate-loading {
        0% {
            transform: rotate(0deg)
        }
        100% {
            transform: rotate(360deg)
        }
    }
    @keyframes swal2-animate-question-mark {
        0% {
            transform: rotateY(-360deg)
        }
        100% {
            transform: rotateY(0)
        }
    }
    @keyframes swal2-animate-i-mark {
        0% {
            transform: rotateZ(45deg);
            opacity: 0
        }
        25% {
            transform: rotateZ(-25deg);
            opacity: .4
        }
        50% {
            transform: rotateZ(15deg);
            opacity: .8
        }
        75% {
            transform: rotateZ(-5deg);
            opacity: 1
        }
        100% {
            transform: rotateX(0);
            opacity: 1
        }
    }
    body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
        overflow: hidden
    }
    body.swal2-height-auto {
        height: auto !important
    }
    body.swal2-no-backdrop .swal2-container {
        background-color: rgba(0, 0, 0, 0) !important;
        pointer-events: none
    }
    body.swal2-no-backdrop .swal2-container .swal2-popup {
        pointer-events: all
    }
    body.swal2-no-backdrop .swal2-container .swal2-modal {
        box-shadow: 0 0 10px rgba(0, 0, 0, .4)
    }
    @media print {
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            overflow-y: scroll !important
        }
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true] {
            display: none
        }
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
            position: static !important
        }
    }
    body.swal2-toast-shown .swal2-container {
        box-sizing: border-box;
        width: 360px;
        max-width: 100%;
        background-color: rgba(0, 0, 0, 0);
        pointer-events: none
    }
    body.swal2-toast-shown .swal2-container.swal2-top {
        inset: 0 auto auto 50%;
        transform: translateX(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-top-end,
    body.swal2-toast-shown .swal2-container.swal2-top-right {
        inset: 0 0 auto auto
    }
    body.swal2-toast-shown .swal2-container.swal2-top-start,
    body.swal2-toast-shown .swal2-container.swal2-top-left {
        inset: 0 auto auto 0
    }
    body.swal2-toast-shown .swal2-container.swal2-center-start,
    body.swal2-toast-shown .swal2-container.swal2-center-left {
        inset: 50% auto auto 0;
        transform: translateY(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-center {
        inset: 50% auto auto 50%;
        transform: translate(-50%, -50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-center-end,
    body.swal2-toast-shown .swal2-container.swal2-center-right {
        inset: 50% 0 auto auto;
        transform: translateY(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom-start,
    body.swal2-toast-shown .swal2-container.swal2-bottom-left {
        inset: auto auto 0 0
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom {
        inset: auto auto 0 50%;
        transform: translateX(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom-end,
    body.swal2-toast-shown .swal2-container.swal2-bottom-right {
        inset: auto 0 0 auto
    }
</style>
<style>
    .swal2-popup.swal2-toast {
        box-sizing: border-box;
        grid-column: 1/4 !important;
        grid-row: 1/4 !important;
        grid-template-columns: min-content auto min-content;
        padding: 1em;
        overflow-y: hidden;
        background: #fff;
        box-shadow: 0 0 1px rgba(0, 0, 0, .075), 0 1px 2px rgba(0, 0, 0, .075), 1px 2px 4px rgba(0, 0, 0, .075), 1px 3px 8px rgba(0, 0, 0, .075), 2px 4px 16px rgba(0, 0, 0, .075);
        pointer-events: all
    }
    .swal2-popup.swal2-toast>* {
        grid-column: 2
    }
    .swal2-popup.swal2-toast .swal2-title {
        margin: .5em 1em;
        padding: 0;
        font-size: 1em;
        text-align: initial
    }
    .swal2-popup.swal2-toast .swal2-loading {
        justify-content: center
    }
    .swal2-popup.swal2-toast .swal2-input {
        height: 2em;
        margin: .5em;
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-validation-message {
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-footer {
        margin: .5em 0 0;
        padding: .5em 0 0;
        font-size: .8em
    }
    .swal2-popup.swal2-toast .swal2-close {
        grid-column: 3/3;
        grid-row: 1/99;
        align-self: center;
        width: .8em;
        height: .8em;
        margin: 0;
        font-size: 2em
    }
    .swal2-popup.swal2-toast .swal2-html-container {
        margin: .5em 1em;
        padding: 0;
        overflow: initial;
        font-size: 1em;
        text-align: initial
    }
    .swal2-popup.swal2-toast .swal2-html-container:empty {
        padding: 0
    }
    .swal2-popup.swal2-toast .swal2-loader {
        grid-column: 1;
        grid-row: 1/99;
        align-self: center;
        width: 2em;
        height: 2em;
        margin: .25em
    }
    .swal2-popup.swal2-toast .swal2-icon {
        grid-column: 1;
        grid-row: 1/99;
        align-self: center;
        width: 2em;
        min-width: 2em;
        height: 2em;
        margin: 0 .5em 0 0
    }
    .swal2-popup.swal2-toast .swal2-icon .swal2-icon-content {
        display: flex;
        align-items: center;
        font-size: 1.8em;
        font-weight: bold
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring {
        width: 2em;
        height: 2em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
        top: .875em;
        width: 1.375em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left] {
        left: .3125em
    }
    .swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
        right: .3125em
    }
    .swal2-popup.swal2-toast .swal2-actions {
        justify-content: flex-start;
        height: auto;
        margin: 0;
        margin-top: .5em;
        padding: 0 .5em
    }
    .swal2-popup.swal2-toast .swal2-styled {
        margin: .25em .5em;
        padding: .4em .6em;
        font-size: 1em
    }
    .swal2-popup.swal2-toast .swal2-success {
        border-color: #a5dc86
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line] {
        position: absolute;
        width: 1.6em;
        height: 3em;
        border-radius: 50%
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left] {
        top: -0.8em;
        left: -0.5em;
        transform: rotate(-45deg);
        transform-origin: 2em 2em;
        border-radius: 4em 0 0 4em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right] {
        top: -0.25em;
        left: .9375em;
        transform-origin: 0 1.5em;
        border-radius: 0 4em 4em 0
    }
    .swal2-popup.swal2-toast .swal2-success .swal2-success-ring {
        width: 2em;
        height: 2em
    }
    .swal2-popup.swal2-toast .swal2-success .swal2-success-fix {
        top: 0;
        left: .4375em;
        width: .4375em;
        height: 2.6875em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line] {
        height: .3125em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip] {
        top: 1.125em;
        left: .1875em;
        width: .75em
    }
    .swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long] {
        top: .9375em;
        right: .1875em;
        width: 1.375em
    }
    .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip {
        animation: swal2-toast-animate-success-line-tip .75s
    }
    .swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long {
        animation: swal2-toast-animate-success-line-long .75s
    }
    .swal2-popup.swal2-toast.swal2-show {
        animation: swal2-toast-show .5s
    }
    .swal2-popup.swal2-toast.swal2-hide {
        animation: swal2-toast-hide .1s forwards
    }
    div:where(.swal2-container) {
        display: grid;
        position: fixed;
        z-index: 1060;
        inset: 0;
        box-sizing: border-box;
        grid-template-areas: "top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";
        grid-template-rows: minmax(min-content, auto) minmax(min-content, auto) minmax(min-content, auto);
        height: 100%;
        padding: .625em;
        overflow-x: hidden;
        transition: background-color .1s;
        -webkit-overflow-scrolling: touch
    }
    div:where(.swal2-container).swal2-backdrop-show,
    div:where(.swal2-container).swal2-noanimation {
        background: rgba(0, 0, 0, .4)
    }
    div:where(.swal2-container).swal2-backdrop-hide {
        background: rgba(0, 0, 0, 0) !important
    }
    div:where(.swal2-container).swal2-top-start,
    div:where(.swal2-container).swal2-center-start,
    div:where(.swal2-container).swal2-bottom-start {
        grid-template-columns: minmax(0, 1fr) auto auto
    }
    div:where(.swal2-container).swal2-top,
    div:where(.swal2-container).swal2-center,
    div:where(.swal2-container).swal2-bottom {
        grid-template-columns: auto minmax(0, 1fr) auto
    }
    div:where(.swal2-container).swal2-top-end,
    div:where(.swal2-container).swal2-center-end,
    div:where(.swal2-container).swal2-bottom-end {
        grid-template-columns: auto auto minmax(0, 1fr)
    }
    div:where(.swal2-container).swal2-top-start>.swal2-popup {
        align-self: start
    }
    div:where(.swal2-container).swal2-top>.swal2-popup {
        grid-column: 2;
        place-self: start center
    }
    div:where(.swal2-container).swal2-top-end>.swal2-popup,
    div:where(.swal2-container).swal2-top-right>.swal2-popup {
        grid-column: 3;
        place-self: start end
    }
    div:where(.swal2-container).swal2-center-start>.swal2-popup,
    div:where(.swal2-container).swal2-center-left>.swal2-popup {
        grid-row: 2;
        align-self: center
    }
    div:where(.swal2-container).swal2-center>.swal2-popup {
        grid-column: 2;
        grid-row: 2;
        place-self: center center
    }
    div:where(.swal2-container).swal2-center-end>.swal2-popup,
    div:where(.swal2-container).swal2-center-right>.swal2-popup {
        grid-column: 3;
        grid-row: 2;
        place-self: center end
    }
    div:where(.swal2-container).swal2-bottom-start>.swal2-popup,
    div:where(.swal2-container).swal2-bottom-left>.swal2-popup {
        grid-column: 1;
        grid-row: 3;
        align-self: end
    }
    div:where(.swal2-container).swal2-bottom>.swal2-popup {
        grid-column: 2;
        grid-row: 3;
        place-self: end center
    }
    div:where(.swal2-container).swal2-bottom-end>.swal2-popup,
    div:where(.swal2-container).swal2-bottom-right>.swal2-popup {
        grid-column: 3;
        grid-row: 3;
        place-self: end end
    }
    div:where(.swal2-container).swal2-grow-row>.swal2-popup,
    div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
        grid-column: 1/4;
        width: 100%
    }
    div:where(.swal2-container).swal2-grow-column>.swal2-popup,
    div:where(.swal2-container).swal2-grow-fullscreen>.swal2-popup {
        grid-row: 1/4;
        align-self: stretch
    }
    div:where(.swal2-container).swal2-no-transition {
        transition: none !important
    }
    div:where(.swal2-container) div:where(.swal2-popup) {
        display: none;
        position: relative;
        box-sizing: border-box;
        grid-template-columns: minmax(0, 100%);
        width: 32em;
        max-width: 100%;
        padding: 0 0 1.25em;
        border: none;
        border-radius: 5px;
        background: #fff;
        color: #545454;
        font-family: inherit;
        font-size: 1rem
    }
    div:where(.swal2-container) div:where(.swal2-popup):focus {
        outline: none
    }
    div:where(.swal2-container) div:where(.swal2-popup).swal2-loading {
        overflow-y: hidden
    }
    div:where(.swal2-container) h2:where(.swal2-title) {
        position: relative;
        max-width: 100%;
        margin: 0;
        padding: .8em 1em 0;
        color: inherit;
        font-size: 1.875em;
        font-weight: 600;
        text-align: center;
        text-transform: none;
        word-wrap: break-word
    }
    div:where(.swal2-container) div:where(.swal2-actions) {
        display: flex;
        z-index: 1;
        box-sizing: border-box;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        width: auto;
        margin: 1.25em auto 0;
        padding: 0
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled[disabled] {
        opacity: .4
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:hover {
        background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1))
    }
    div:where(.swal2-container) div:where(.swal2-actions):not(.swal2-loading) .swal2-styled:active {
        background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2))
    }
    div:where(.swal2-container) div:where(.swal2-loader) {
        display: none;
        align-items: center;
        justify-content: center;
        width: 2.2em;
        height: 2.2em;
        margin: 0 1.875em;
        animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
        border-width: .25em;
        border-style: solid;
        border-radius: 100%;
        border-color: #2778c4 rgba(0, 0, 0, 0) #2778c4 rgba(0, 0, 0, 0)
    }
    div:where(.swal2-container) button:where(.swal2-styled) {
        margin: .3125em;
        padding: .625em 1.1em;
        transition: box-shadow .1s;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0);
        font-weight: 500
    }
    div:where(.swal2-container) button:where(.swal2-styled):not([disabled]) {
        cursor: pointer
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #7066e0;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
        box-shadow: 0 0 0 3px rgba(112, 102, 224, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-deny {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #dc3741;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-deny:focus {
        box-shadow: 0 0 0 3px rgba(220, 55, 65, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel {
        border: 0;
        border-radius: .25em;
        background: initial;
        background-color: #6e7881;
        color: #fff;
        font-size: 1em
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-cancel:focus {
        box-shadow: 0 0 0 3px rgba(110, 120, 129, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled).swal2-default-outline:focus {
        box-shadow: 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) button:where(.swal2-styled):focus {
        outline: none
    }
    div:where(.swal2-container) button:where(.swal2-styled)::-moz-focus-inner {
        border: 0
    }
    div:where(.swal2-container) div:where(.swal2-footer) {
        margin: 1em 0 0;
        padding: 1em 1em 0;
        border-top: 1px solid #eee;
        color: inherit;
        font-size: 1em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-timer-progress-bar-container {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        grid-column: auto !important;
        overflow: hidden;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px
    }
    div:where(.swal2-container) div:where(.swal2-timer-progress-bar) {
        width: 100%;
        height: .25em;
        background: rgba(0, 0, 0, .2)
    }
    div:where(.swal2-container) img:where(.swal2-image) {
        max-width: 100%;
        margin: 2em auto 1em
    }
    div:where(.swal2-container) button:where(.swal2-close) {
        z-index: 2;
        align-items: center;
        justify-content: center;
        width: 1.2em;
        height: 1.2em;
        margin-top: 0;
        margin-right: 0;
        margin-bottom: -1.2em;
        padding: 0;
        overflow: hidden;
        transition: color .1s, box-shadow .1s;
        border: none;
        border-radius: 5px;
        background: rgba(0, 0, 0, 0);
        color: #ccc;
        font-family: monospace;
        font-size: 2.5em;
        cursor: pointer;
        justify-self: end
    }
    div:where(.swal2-container) button:where(.swal2-close):hover {
        transform: none;
        background: rgba(0, 0, 0, 0);
        color: #f27474
    }
    div:where(.swal2-container) button:where(.swal2-close):focus {
        outline: none;
        box-shadow: inset 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) button:where(.swal2-close)::-moz-focus-inner {
        border: 0
    }
    div:where(.swal2-container) .swal2-html-container {
        z-index: 1;
        justify-content: center;
        margin: 1em 1.6em .3em;
        padding: 0;
        overflow: auto;
        color: inherit;
        font-size: 1.125em;
        font-weight: normal;
        line-height: normal;
        text-align: center;
        word-wrap: break-word;
        word-break: break-word
    }
    div:where(.swal2-container) input:where(.swal2-input),
    div:where(.swal2-container) input:where(.swal2-file),
    div:where(.swal2-container) textarea:where(.swal2-textarea),
    div:where(.swal2-container) select:where(.swal2-select),
    div:where(.swal2-container) div:where(.swal2-radio),
    div:where(.swal2-container) label:where(.swal2-checkbox) {
        margin: 1em 2em 3px
    }
    div:where(.swal2-container) input:where(.swal2-input),
    div:where(.swal2-container) input:where(.swal2-file),
    div:where(.swal2-container) textarea:where(.swal2-textarea) {
        box-sizing: border-box;
        width: auto;
        transition: border-color .1s, box-shadow .1s;
        border: 1px solid #d9d9d9;
        border-radius: .1875em;
        background: rgba(0, 0, 0, 0);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(0, 0, 0, 0);
        color: inherit;
        font-size: 1.125em
    }
    div:where(.swal2-container) input:where(.swal2-input).swal2-inputerror,
    div:where(.swal2-container) input:where(.swal2-file).swal2-inputerror,
    div:where(.swal2-container) textarea:where(.swal2-textarea).swal2-inputerror {
        border-color: #f27474 !important;
        box-shadow: 0 0 2px #f27474 !important
    }
    div:where(.swal2-container) input:where(.swal2-input):focus,
    div:where(.swal2-container) input:where(.swal2-file):focus,
    div:where(.swal2-container) textarea:where(.swal2-textarea):focus {
        border: 1px solid #b4dbed;
        outline: none;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .06), 0 0 0 3px rgba(100, 150, 200, .5)
    }
    div:where(.swal2-container) input:where(.swal2-input)::placeholder,
    div:where(.swal2-container) input:where(.swal2-file)::placeholder,
    div:where(.swal2-container) textarea:where(.swal2-textarea)::placeholder {
        color: #ccc
    }
    div:where(.swal2-container) .swal2-range {
        margin: 1em 2em 3px;
        background: #fff
    }
    div:where(.swal2-container) .swal2-range input {
        width: 80%
    }
    div:where(.swal2-container) .swal2-range output {
        width: 20%;
        color: inherit;
        font-weight: 600;
        text-align: center
    }
    div:where(.swal2-container) .swal2-range input,
    div:where(.swal2-container) .swal2-range output {
        height: 2.625em;
        padding: 0;
        font-size: 1.125em;
        line-height: 2.625em
    }
    div:where(.swal2-container) .swal2-input {
        height: 2.625em;
        padding: 0 .75em
    }
    div:where(.swal2-container) .swal2-file {
        width: 75%;
        margin-right: auto;
        margin-left: auto;
        background: rgba(0, 0, 0, 0);
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-textarea {
        height: 6.75em;
        padding: .75em
    }
    div:where(.swal2-container) .swal2-select {
        min-width: 50%;
        max-width: 100%;
        padding: .375em .625em;
        background: rgba(0, 0, 0, 0);
        color: inherit;
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-radio,
    div:where(.swal2-container) .swal2-checkbox {
        align-items: center;
        justify-content: center;
        background: #fff;
        color: inherit
    }
    div:where(.swal2-container) .swal2-radio label,
    div:where(.swal2-container) .swal2-checkbox label {
        margin: 0 .6em;
        font-size: 1.125em
    }
    div:where(.swal2-container) .swal2-radio input,
    div:where(.swal2-container) .swal2-checkbox input {
        flex-shrink: 0;
        margin: 0 .4em
    }
    div:where(.swal2-container) label:where(.swal2-input-label) {
        display: flex;
        justify-content: center;
        margin: 1em auto 0
    }
    div:where(.swal2-container) div:where(.swal2-validation-message) {
        align-items: center;
        justify-content: center;
        margin: 1em 0 0;
        padding: .625em;
        overflow: hidden;
        background: #f0f0f0;
        color: #666;
        font-size: 1em;
        font-weight: 300
    }
    div:where(.swal2-container) div:where(.swal2-validation-message)::before {
        content: "!";
        display: inline-block;
        width: 1.5em;
        min-width: 1.5em;
        height: 1.5em;
        margin: 0 .625em;
        border-radius: 50%;
        background-color: #f27474;
        color: #fff;
        font-weight: 600;
        line-height: 1.5em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-progress-steps {
        flex-wrap: wrap;
        align-items: center;
        max-width: 100%;
        margin: 1.25em auto;
        padding: 0;
        background: rgba(0, 0, 0, 0);
        font-weight: 600
    }
    div:where(.swal2-container) .swal2-progress-steps li {
        display: inline-block;
        position: relative
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step {
        z-index: 20;
        flex-shrink: 0;
        width: 2em;
        height: 2em;
        border-radius: 2em;
        background: #2778c4;
        color: #fff;
        line-height: 2em;
        text-align: center
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step {
        background: #2778c4
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step {
        background: #add8e6;
        color: #fff
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line {
        background: #add8e6
    }
    div:where(.swal2-container) .swal2-progress-steps .swal2-progress-step-line {
        z-index: 10;
        flex-shrink: 0;
        width: 2.5em;
        height: .4em;
        margin: 0 -1px;
        background: #2778c4
    }
    div:where(.swal2-icon) {
        position: relative;
        box-sizing: content-box;
        justify-content: center;
        width: 5em;
        height: 5em;
        margin: 2.5em auto .6em;
        border: 0.25em solid rgba(0, 0, 0, 0);
        border-radius: 50%;
        border-color: #000;
        font-family: inherit;
        line-height: 5em;
        cursor: default;
        user-select: none
    }
    div:where(.swal2-icon) .swal2-icon-content {
        display: flex;
        align-items: center;
        font-size: 3.75em
    }
    div:where(.swal2-icon).swal2-error {
        border-color: #f27474;
        color: #f27474
    }
    div:where(.swal2-icon).swal2-error .swal2-x-mark {
        position: relative;
        flex-grow: 1
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line] {
        display: block;
        position: absolute;
        top: 2.3125em;
        width: 2.9375em;
        height: .3125em;
        border-radius: .125em;
        background-color: #f27474
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=left] {
        left: 1.0625em;
        transform: rotate(45deg)
    }
    div:where(.swal2-icon).swal2-error [class^=swal2-x-mark-line][class$=right] {
        right: 1em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-error.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
        animation: swal2-animate-error-x-mark .5s
    }
    div:where(.swal2-icon).swal2-warning {
        border-color: #facea8;
        color: #f8bb86
    }
    div:where(.swal2-icon).swal2-warning.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-warning.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-i-mark .5s
    }
    div:where(.swal2-icon).swal2-info {
        border-color: #9de0f6;
        color: #3fc3ee
    }
    div:where(.swal2-icon).swal2-info.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-info.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-i-mark .8s
    }
    div:where(.swal2-icon).swal2-question {
        border-color: #c9dae1;
        color: #87adbd
    }
    div:where(.swal2-icon).swal2-question.swal2-icon-show {
        animation: swal2-animate-error-icon .5s
    }
    div:where(.swal2-icon).swal2-question.swal2-icon-show .swal2-icon-content {
        animation: swal2-animate-question-mark .8s
    }
    div:where(.swal2-icon).swal2-success {
        border-color: #a5dc86;
        color: #a5dc86
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line] {
        position: absolute;
        width: 3.75em;
        height: 7.5em;
        border-radius: 50%
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=left] {
        top: -0.4375em;
        left: -2.0635em;
        transform: rotate(-45deg);
        transform-origin: 3.75em 3.75em;
        border-radius: 7.5em 0 0 7.5em
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-circular-line][class$=right] {
        top: -0.6875em;
        left: 1.875em;
        transform: rotate(-45deg);
        transform-origin: 0 3.75em;
        border-radius: 0 7.5em 7.5em 0
    }
    div:where(.swal2-icon).swal2-success .swal2-success-ring {
        position: absolute;
        z-index: 2;
        top: -0.25em;
        left: -0.25em;
        box-sizing: content-box;
        width: 100%;
        height: 100%;
        border: .25em solid rgba(165, 220, 134, .3);
        border-radius: 50%
    }
    div:where(.swal2-icon).swal2-success .swal2-success-fix {
        position: absolute;
        z-index: 1;
        top: .5em;
        left: 1.625em;
        width: .4375em;
        height: 5.625em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line] {
        display: block;
        position: absolute;
        z-index: 2;
        height: .3125em;
        border-radius: .125em;
        background-color: #a5dc86
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=tip] {
        top: 2.875em;
        left: .8125em;
        width: 1.5625em;
        transform: rotate(45deg)
    }
    div:where(.swal2-icon).swal2-success [class^=swal2-success-line][class$=long] {
        top: 2.375em;
        right: .5em;
        width: 2.9375em;
        transform: rotate(-45deg)
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-tip {
        animation: swal2-animate-success-line-tip .75s
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-line-long {
        animation: swal2-animate-success-line-long .75s
    }
    div:where(.swal2-icon).swal2-success.swal2-icon-show .swal2-success-circular-line-right {
        animation: swal2-rotate-success-circular-line 4.25s ease-in
    }
    [class^=swal2] {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
    }
    .swal2-show {
        animation: swal2-show .3s
    }
    .swal2-hide {
        animation: swal2-hide .15s forwards
    }
    .swal2-noanimation {
        transition: none
    }
    .swal2-scrollbar-measure {
        position: absolute;
        top: -9999px;
        width: 50px;
        height: 50px;
        overflow: scroll
    }
    .swal2-rtl .swal2-close {
        margin-right: initial;
        margin-left: 0
    }
    .swal2-rtl .swal2-timer-progress-bar {
        right: 0;
        left: auto
    }
    @keyframes swal2-toast-show {
        0% {
            transform: translateY(-0.625em) rotateZ(2deg)
        }
        33% {
            transform: translateY(0) rotateZ(-2deg)
        }
        66% {
            transform: translateY(0.3125em) rotateZ(2deg)
        }
        100% {
            transform: translateY(0) rotateZ(0deg)
        }
    }
    @keyframes swal2-toast-hide {
        100% {
            transform: rotateZ(1deg);
            opacity: 0
        }
    }
    @keyframes swal2-toast-animate-success-line-tip {
        0% {
            top: .5625em;
            left: .0625em;
            width: 0
        }
        54% {
            top: .125em;
            left: .125em;
            width: 0
        }
        70% {
            top: .625em;
            left: -0.25em;
            width: 1.625em
        }
        84% {
            top: 1.0625em;
            left: .75em;
            width: .5em
        }
        100% {
            top: 1.125em;
            left: .1875em;
            width: .75em
        }
    }
    @keyframes swal2-toast-animate-success-line-long {
        0% {
            top: 1.625em;
            right: 1.375em;
            width: 0
        }
        65% {
            top: 1.25em;
            right: .9375em;
            width: 0
        }
        84% {
            top: .9375em;
            right: 0;
            width: 1.125em
        }
        100% {
            top: .9375em;
            right: .1875em;
            width: 1.375em
        }
    }
    @keyframes swal2-show {
        0% {
            transform: scale(0.7)
        }
        45% {
            transform: scale(1.05)
        }
        80% {
            transform: scale(0.95)
        }
        100% {
            transform: scale(1)
        }
    }
    @keyframes swal2-hide {
        0% {
            transform: scale(1);
            opacity: 1
        }
        100% {
            transform: scale(0.5);
            opacity: 0
        }
    }
    @keyframes swal2-animate-success-line-tip {
        0% {
            top: 1.1875em;
            left: .0625em;
            width: 0
        }
        54% {
            top: 1.0625em;
            left: .125em;
            width: 0
        }
        70% {
            top: 2.1875em;
            left: -0.375em;
            width: 3.125em
        }
        84% {
            top: 3em;
            left: 1.3125em;
            width: 1.0625em
        }
        100% {
            top: 2.8125em;
            left: .8125em;
            width: 1.5625em
        }
    }
    @keyframes swal2-animate-success-line-long {
        0% {
            top: 3.375em;
            right: 2.875em;
            width: 0
        }
        65% {
            top: 3.375em;
            right: 2.875em;
            width: 0
        }
        84% {
            top: 2.1875em;
            right: 0;
            width: 3.4375em
        }
        100% {
            top: 2.375em;
            right: .5em;
            width: 2.9375em
        }
    }
    @keyframes swal2-rotate-success-circular-line {
        0% {
            transform: rotate(-45deg)
        }
        5% {
            transform: rotate(-45deg)
        }
        12% {
            transform: rotate(-405deg)
        }
        100% {
            transform: rotate(-405deg)
        }
    }
    @keyframes swal2-animate-error-x-mark {
        0% {
            margin-top: 1.625em;
            transform: scale(0.4);
            opacity: 0
        }
        50% {
            margin-top: 1.625em;
            transform: scale(0.4);
            opacity: 0
        }
        80% {
            margin-top: -0.375em;
            transform: scale(1.15)
        }
        100% {
            margin-top: 0;
            transform: scale(1);
            opacity: 1
        }
    }
    @keyframes swal2-animate-error-icon {
        0% {
            transform: rotateX(100deg);
            opacity: 0
        }
        100% {
            transform: rotateX(0deg);
            opacity: 1
        }
    }
    @keyframes swal2-rotate-loading {
        0% {
            transform: rotate(0deg)
        }
        100% {
            transform: rotate(360deg)
        }
    }
    @keyframes swal2-animate-question-mark {
        0% {
            transform: rotateY(-360deg)
        }
        100% {
            transform: rotateY(0)
        }
    }
    @keyframes swal2-animate-i-mark {
        0% {
            transform: rotateZ(45deg);
            opacity: 0
        }
        25% {
            transform: rotateZ(-25deg);
            opacity: .4
        }
        50% {
            transform: rotateZ(15deg);
            opacity: .8
        }
        75% {
            transform: rotateZ(-5deg);
            opacity: 1
        }
        100% {
            transform: rotateX(0);
            opacity: 1
        }
    }
    body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
        overflow: hidden
    }
    body.swal2-height-auto {
        height: auto !important
    }
    body.swal2-no-backdrop .swal2-container {
        background-color: rgba(0, 0, 0, 0) !important;
        pointer-events: none
    }
    body.swal2-no-backdrop .swal2-container .swal2-popup {
        pointer-events: all
    }
    body.swal2-no-backdrop .swal2-container .swal2-modal {
        box-shadow: 0 0 10px rgba(0, 0, 0, .4)
    }
    @media print {
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) {
            overflow-y: scroll !important
        }
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true] {
            display: none
        }
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container {
            position: static !important
        }
    }
    body.swal2-toast-shown .swal2-container {
        box-sizing: border-box;
        width: 360px;
        max-width: 100%;
        background-color: rgba(0, 0, 0, 0);
        pointer-events: none
    }
    body.swal2-toast-shown .swal2-container.swal2-top {
        inset: 0 auto auto 50%;
        transform: translateX(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-top-end,
    body.swal2-toast-shown .swal2-container.swal2-top-right {
        inset: 0 0 auto auto
    }
    body.swal2-toast-shown .swal2-container.swal2-top-start,
    body.swal2-toast-shown .swal2-container.swal2-top-left {
        inset: 0 auto auto 0
    }
    body.swal2-toast-shown .swal2-container.swal2-center-start,
    body.swal2-toast-shown .swal2-container.swal2-center-left {
        inset: 50% auto auto 0;
        transform: translateY(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-center {
        inset: 50% auto auto 50%;
        transform: translate(-50%, -50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-center-end,
    body.swal2-toast-shown .swal2-container.swal2-center-right {
        inset: 50% 0 auto auto;
        transform: translateY(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom-start,
    body.swal2-toast-shown .swal2-container.swal2-bottom-left {
        inset: auto auto 0 0
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom {
        inset: auto auto 0 50%;
        transform: translateX(-50%)
    }
    body.swal2-toast-shown .swal2-container.swal2-bottom-end,
    body.swal2-toast-shown .swal2-container.swal2-bottom-right {
        inset: auto 0 0 auto
    }
</style>
<style>
    .card-body i.fas {
        color: #fff;
    }
</style>
@endsection
@section('content')
<main class="main blurred" id="main">
    <div class="pagetitle">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 row d-flex justify-content-between">
                        <div class="col-4">
                            <form action="https://smartnet.az/organizations" method="GET">
                                <div class="input-group">
                                    <input class="form-control" name="q" placeholder="Axtar" type="text"
                                        value="">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id="editDebug"
                            style="background:#000;color:#0f0;padding:10px;font-size:12px;margin-bottom:10px;display:none">
                        </div>
                        <div class="col-6">
                            <div
                                class="d-flex flex-nowrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                                
                                <a class="create_new btn btn-primary add-custom" data-bs-target="#newOrgModal"
                                    data-bs-toggle="modal" href="javascript:void(0)" id="contactModal" data-id="">
                                    <i class="uil uil-plus me-1"></i>Yenisini yarat</a>
                            </div>
                            <!--Yenisini yarat modal-->
                            <div aria-hidden="true" aria-labelledby="newOrgModalLabel" class="modal fade"
                                id="newOrgModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <form class="modal-content needs-validation" id="newOrgForm" novalidate=""
                                        method="POST" action="{{ route('structure.store') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newOrgModalLabel">Yenisini yarat</h5>
                                            <button aria-label="Bağla" class="btn-close" data-bs-dismiss="modal"
                                                type="button"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3 align-items-center">
                                                <!--parent-id-->
                                                <input type="hidden" name="parent_id" id="parent_id" value="">
                                                <!-- Ad -->
                                                <div class="col-md-8">
                                                    <label class="form-label" for="vahidAdi">Adı</label>
                                                    <input class="form-control" id="vahidAdi" name="name"
                                                        placeholder="" required="" type="text">
                                                    <div class="invalid-feedback">Adı</div>
                                                </div>
                                                <!-- Tip -->
                                                <div class="col-md-4">
                                                    <label class="form-label" for="vahidTipi">Növü</label>
                                                    <select class="form-select" id="vahidTipi"
                                                        name="organization_type_id" required>
                                                        <option hidden selected value="">Seçin</option>
                                                        @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">
                                                            {{ $type->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Tip seçin.</div>
                                                </div>
                                                <!-- Qısa ad -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Qısa Ad</label>
                                                    <input type="text" class="form-control" name="short_name">
                                                </div>
                                                <!-- Ünvan -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Ünvan</label>
                                                    <input type="text" class="form-control" name="address">
                                                </div>
                                                <!-- E-poçt -->
                                                <div class="col-md-6">
                                                    <label class="form-label">E-poçt ünvanı</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                                <!-- Fax -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Fax</label>
                                                    <input type="text" class="form-control" name="fax">
                                                </div>
                                                <!-- Telefon -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Telefon</label>
                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                type="button">Bağla</button>
                                            <button class="btn btn-primary" type="submit">Yadda saxla</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--Redakte et modal-->
                            <div aria-hidden="true" aria-labelledby="editOrgModalLabel" class="modal fade"
                                id="editOrgModal" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <form class="modal-content needs-validation" id="editOrgForm" novalidate=""
                                        method="POST" action="{{ route('structure.update') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editOrgModalLabel">Redaktə et</h5>
                                            <button aria-label="Bağla" class="btn-close" data-bs-dismiss="modal"
                                                type="button"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3 align-items-center">
                                                <!--id-->
                                                <input type="hidden" name="org_id" id="org_id" value="">
                                                <!-- Ad -->
                                                <div class="col-md-8">
                                                    <label class="form-label" for="org_name">Adı</label>
                                                    <input class="form-control" id="org_name" name="name"
                                                        placeholder="" required="" type="text">
                                                    <div class="invalid-feedback">Adı</div>
                                                </div>
                                                <!-- Tip -->
                                                <div class="col-md-4">
                                                    <label class="form-label" for="org_type">Növü</label>
                                                    <select class="form-select" id="org_type"
                                                        name="organization_type_id" required>
                                                        <option disabled selected value="">Seçin</option>
                                                        @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">
                                                            {{ $type->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Tip seçin.</div>
                                                </div>
                                                <!-- Qısa ad -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Qısa Ad</label>
                                                    <input type="text" class="form-control" name="short_name"
                                                        id="org_short_name">
                                                </div>
                                                <!-- Ünvan -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Ünvan</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="org_address">
                                                </div>
                                                <!-- E-poçt -->
                                                <div class="col-md-6">
                                                    <label class="form-label">E-poçt ünvanı</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="org_email">
                                                </div>
                                                <!-- Fax -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Fax</label>
                                                    <input type="text" class="form-control" name="fax"
                                                        id="org_fax">
                                                </div>
                                                <!-- Telefon -->
                                                <div class="col-md-3">
                                                    <label class="form-label">Telefon</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        id="org_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                type="button">Bağla</button>
                                            <button class="btn btn-primary" type="submit">Yadda saxla</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <ul class="wtree" id="tree">
                            @foreach ($trees as $node)
                            @include('pages.structure.tree-node', ['node' => $node])
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
</main>
<a class="back-to-top d-flex align-items-center justify-content-center" href="javascript:void(0)"><i
        class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
<script>
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('.click');
        if (!trigger) return;
        const li = trigger.closest('li');
        const childUl = li?.querySelector(':scope > ul');
        if (!childUl) return;
        childUl.style.display = (childUl.style.display === 'none') ? 'block' : 'none';
    });
</script>
<script>
    function openEditContactModal1(button) {
        let durationId = button.getAttribute("data-duration-id");
        let positionName = button.closest("tr").querySelector("td:nth-child(2)").innerText;
        document.getElementById("edit_duration_id").value = durationId;
        document.getElementById("edit_position_name").value = positionName;
        let modal = new bootstrap.Modal(document.getElementById('editContactModal1'));
        modal.show();
    }
</script>
<script>
    document.querySelectorAll(".archive_person").forEach(btn => {
        btn.addEventListener("click", function() {
            let url = this.getAttribute("data-url");
            Swal.fire({
                title: 'Arxivləmək istəyirsiniz?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Bəli, sil',
                cancelButtonText: 'Xeyr'
            });
        });
    });
</script>
<script>
    document.querySelectorAll(".delete_person").forEach(btn => {
        btn.addEventListener("click", function() {
            let url = this.getAttribute("data-url");
            Swal.fire({
                title: 'Silmək istəyirsiniz?',
                text: "Bu əməliyyat geri qaytarıla bilməz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Bəli, sil',
                cancelButtonText: 'Xeyr'
            });
        });
    });
</script>
<script id="v5c4k9">
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.add-custom');
        if (btn) {
            document.getElementById('parent_id').value = btn.dataset.id || '';
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('vahidTipi').selectedIndex = 0;
    });
</script>
<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-custom');
        if (!btn) return;
        const modalSel = btn.getAttribute('data-bs-target'); // #editOrgModal
        const modalEl = document.querySelector(modalSel);
        if (!modalEl) return;
        // dataset-dən oxu (data-short-name => btn.dataset.shortName)
        const data = {
            id: btn.dataset.id || '',
            name: btn.dataset.name || '',
            typeId: btn.dataset.typeId || '',
            shortName: btn.dataset.shortName || '',
            address: btn.dataset.address || '',
            email: btn.dataset.email || '',
            fax: btn.dataset.fax || '',
            phone: btn.dataset.phone || '',
        };
        // modal inputlarını tap və doldur
        const setVal = (selector, value) => {
            const el = modalEl.querySelector(selector);
            if (el) el.value = value ?? '';
        };
        setVal('#org_id', data.id);
        setVal('#org_name', data.name);
        setVal('#org_type', data.typeId);
        setVal('#org_short_name', data.shortName);
        setVal('#org_address', data.address);
        setVal('#org_email', data.email);
        setVal('#org_fax', data.fax);
        setVal('#org_phone', data.phone);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-status').forEach(function(sw) {
            const label = sw.closest('.form-check')
                .querySelector('.status-label');
            if (sw.checked) {
                label.textContent = 'Aktiv';
            } else {
                label.textContent = 'Deaktiv';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateLabel(sw) {
            const label = sw.closest('.form-check')
                .querySelector('.status-label');
            label.textContent = sw.checked ? 'Aktiv' : 'Deaktiv';
        }
        document.querySelectorAll('.toggle-status').forEach(function(sw) {
            updateLabel(sw);
            sw.addEventListener('change', function() {
                updateLabel(sw);
            });
        });
    });
</script>
<script>
    document.querySelectorAll('.toggle-status').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            let id = this.dataset.id;
            Swal.fire({
                title: 'Yüklənir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            fetch("{{ route('structure.change') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        timer: 1200,
                        showConfirmButton: false
                    });
                    console.log("Yeni status:", data.status);
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta baş verdi'
                    });
                    console.error(err);
                });
        });
    });
</script>
<script>
    let selected_li = null; // global dəyişən
    document.querySelectorAll(".add-custom").forEach(btn => {
        btn.addEventListener("click", function() {
            selected_li = this.closest("li"); // hansı node seçildiyini yadda saxla
            console.log(selected_li);
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("newOrgForm");
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            e.stopPropagation();
            let formData = new FormData(form);
            Swal.fire({
                title: 'Yüklənir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Uğurlu',
                            text: data.message
                        });
                        const id = data.id;
                        const name = form.querySelector('[name="name"]').value;
                        const typeSelect = form.querySelector('[name="organization_type_id"]');
                        const typeText = typeSelect.options[typeSelect.selectedIndex].text;
                        const short_name = form.querySelector('[name="short_name"]').value ?? '';
                        const address = form.querySelector('[name="address"]').value ?? '';
                        const email = form.querySelector('[name="email"]').value ?? '';
                        const fax = form.querySelector('[name="fax"]').value ?? '';
                        const phone = form.querySelector('[name="phone"]').value ?? '';
                        const newLi = document.createElement("li");
                        newLi.innerHTML = `
                            <span class="col-12">
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="click col-10">
                                        ${name} | ${typeText}
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <a class="btn create_new btn-sm btn-info me-1 add-custom"
                                        data-bs-target="#newOrgModal"
                                        data-bs-toggle="modal"
                                        data-id="${id}"
                                        href="javascript:void(0)"
                                        title="Əlavə et">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a class="btn btn-sm btn-success me-2"
                                        data-id="${id}"
                                        href="/struktur/struktur-etrafli/${id}"
                                        title="Ətraflı">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="edit-custom btn btn-sm btn-info me-3"
                                        data-bs-target="#editOrgModal"
                                        data-bs-toggle="modal"
                                        data-id="${id}"
                                        data-name="${name}"
                                        data-type-id="${typeSelect.value}"
                                        data-short-name="${short_name}"
                                        data-address="${address}"
                                        data-email="${email}"
                                        data-fax="${fax}"
                                        data-phone="${phone}"
                                        href="javascript:void(0)"
                                        title="Redaktə et">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-status"
                                                type="checkbox"
                                                id="switch-${id}"
                                                data-id="${id}"
                                                checked>
                                            <label class="form-check-label" for="switch-${id}">
                                                Aktiv
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            `;
                        if (selected_li) {
                            let childUl = selected_li.querySelector("ul");
                            if (childUl) {
                                childUl.prepend(newLi);
                            } else {
                                const ul = document.createElement("ul");
                                ul.style.display = "none"; // səndə tree-də belə idi
                                ul.appendChild(newLi);
                                const span = selected_li.querySelector("span");
                                span.style.background = "#038edc17"; // tree-dəki kimi fon rəngi
                                span.insertAdjacentElement("afterend", ul);
                            }
                        } else {
                            // selected_li null-dursa, root-ul tap və prepend et
                            const treeUl = document.querySelector("ul#tree");
                            if (treeUl) {
                                treeUl.prepend(newLi);
                            } else {
                                console.error("ul#tree tapılmadı!");
                            }
                        }
                        form.reset();
                        let modal = bootstrap.Modal.getInstance(document.getElementById('newOrgModal'));
                        modal.hide();
                        document.querySelectorAll(".add-custom").forEach(btn => {
                            btn.addEventListener("click", function() {
                                selected_li = this.closest("li"); // hansı node seçildiyini yadda saxla
                                console.log(selected_li);
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Xəta',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Server xətası',
                        text: 'Sorğu göndərilərkən problem yarandı'
                    });
                });
        });
    });
</script>
<script>
    let selected_span = null;
    document.addEventListener("click", function(e) {
        const btn = e.target.closest(".edit-custom");
        if (!btn) return;
        selected_span = btn.closest("span");
        const d = btn.dataset;
        document.getElementById("org_id").value = d.id || "";
        document.getElementById("org_name").value = d.name || "";
        document.getElementById("org_type").value = d.typeId || "";
        document.getElementById("org_short_name").value = d.shortName || "";
        document.getElementById("org_address").value = d.address || "";
        document.getElementById("org_email").value = d.email || "";
        document.getElementById("org_fax").value = d.fax || "";
        document.getElementById("org_phone").value = d.phone || "";
    });
    document.getElementById("editOrgForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        Swal.fire({
                title: 'Yüklənir...',
                text: 'Zəhmət olmasa gözləyin',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Uğurlu",
                        text: data.message
                    });
                    if (selected_span) {
                        const clickDiv = selected_span.querySelector(".click");
                        clickDiv.textContent =
                            data.node.name + " | " + data.node.type_name;
                        const editBtn = selected_span.querySelector(".edit-custom");
                        editBtn.dataset.name = data.node.name;
                        editBtn.dataset.typeId = data.node.organization_type_id;
                        editBtn.dataset.shortName = data.node.short_name ?? "";
                        editBtn.dataset.address = data.node.address ?? "";
                        editBtn.dataset.email = data.node.email ?? "";
                        editBtn.dataset.fax = data.node.fax ?? "";
                        editBtn.dataset.phone = data.node.phone ?? "";
                    }
                    const modal = bootstrap.Modal.getInstance(document.getElementById("editOrgModal"));
                    modal.hide();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Xəta",
                        text: data.message
                    });
                }
            })
            .catch(err => {
                console.log(err);
                Swal.fire({
                    icon: "error",
                    title: "Server xətası",
                    text: "Sorğu göndərilərkən problem yarandı"
                });
            });
    });
</script>
<!-- @if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Uğurlu',
        text: @json(session('success')),
        timer: 1500,
        showConfirmButton: false
    });
</script>
@endif
@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Xəta',
        text: @json(session('error')),
    });
</script>
@endif -->
@endsection