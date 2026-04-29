@extends('layouts.index')
@section('css')
    <style id="apexcharts-css">
        @keyframes opaque {
            0% {
                opacity: 0
            }
            to {
                opacity: 1
            }
        }
        @keyframes resizeanim {
            0%,
            to {
                opacity: 0
            }
        }
        .apexcharts-canvas {
            position: relative;
            direction: ltr !important;
            user-select: none
        }
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px
        }
        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5)
        }
        .apexcharts-inner {
            position: relative
        }
        .apexcharts-text tspan {
            font-family: inherit
        }
        rect.legend-mouseover-inactive,
        .legend-mouseover-inactive rect,
        .legend-mouseover-inactive path,
        .legend-mouseover-inactive circle,
        .legend-mouseover-inactive line,
        .legend-mouseover-inactive text.apexcharts-yaxis-title-text,
        .legend-mouseover-inactive text.apexcharts-yaxis-label {
            transition: .15s ease all;
            opacity: .2
        }
        .apexcharts-legend-text {
            padding-left: 15px;
            margin-left: -15px;
        }
        .apexcharts-series-collapsed {
            opacity: 0
        }
        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: .15s ease all
        }
        .apexcharts-tooltip.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }
        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, .96)
        }
        .apexcharts-tooltip.apexcharts-theme-dark {
            color: #fff;
            background: rgba(30, 30, 30, .8)
        }
        .apexcharts-tooltip * {
            font-family: inherit
        }
        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px
        }
        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #eceff1;
            border-bottom: 1px solid #ddd
        }
        .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, .7);
            border-bottom: 1px solid #333
        }
        .apexcharts-tooltip-text-goals-value,
        .apexcharts-tooltip-text-y-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            margin-left: 5px;
            font-weight: 600
        }
        .apexcharts-tooltip-text-goals-label:empty,
        .apexcharts-tooltip-text-goals-value:empty,
        .apexcharts-tooltip-text-y-label:empty,
        .apexcharts-tooltip-text-y-value:empty,
        .apexcharts-tooltip-text-z-value:empty,
        .apexcharts-tooltip-title:empty {
            display: none
        }
        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            padding: 6px 0 5px
        }
        .apexcharts-tooltip-goals-group,
        .apexcharts-tooltip-text-goals-label,
        .apexcharts-tooltip-text-goals-value {
            display: flex
        }
        .apexcharts-tooltip-text-goals-label:not(:empty),
        .apexcharts-tooltip-text-goals-value:not(:empty) {
            margin-top: -6px
        }
        .apexcharts-tooltip-marker {
            display: inline-block;
            position: relative;
            width: 16px;
            height: 16px;
            font-size: 16px;
            line-height: 16px;
            margin-right: 4px;
            text-align: center;
            vertical-align: middle;
            color: inherit;
        }
        .apexcharts-tooltip-marker::before {
            content: "";
            display: inline-block;
            width: 100%;
            text-align: center;
            color: currentcolor;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            font-size: 26px;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 14px;
            font-weight: 900;
        }
        .apexcharts-tooltip-marker[shape="circle"]::before {
            content: "\25CF";
        }
        .apexcharts-tooltip-marker[shape="square"]::before,
        .apexcharts-tooltip-marker[shape="rect"]::before {
            content: "\25A0";
            transform: translate(-1px, -2px);
        }
        .apexcharts-tooltip-marker[shape="line"]::before {
            content: "\2500";
        }
        .apexcharts-tooltip-marker[shape="diamond"]::before {
            content: "\25C6";
            font-size: 28px;
        }
        .apexcharts-tooltip-marker[shape="triangle"]::before {
            content: "\25B2";
            font-size: 22px;
        }
        .apexcharts-tooltip-marker[shape="cross"]::before {
            content: "\2715";
            font-size: 18px;
        }
        .apexcharts-tooltip-marker[shape="plus"]::before {
            content: "\2715";
            transform: rotate(45deg) translate(-1px, -1px);
            font-size: 18px;
        }
        .apexcharts-tooltip-marker[shape="star"]::before {
            content: "\2605";
            font-size: 18px;
        }
        .apexcharts-tooltip-marker[shape="sparkle"]::before {
            content: "\2726";
            font-size: 20px;
        }
        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center
        }
        .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
            opacity: 1
        }
        .apexcharts-tooltip-series-group.apexcharts-active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px
        }
        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px
        }
        .apexcharts-custom-tooltip,
        .apexcharts-tooltip-box {
            padding: 4px 8px
        }
        .apexcharts-tooltip-boxPlot {
            display: flex;
            flex-direction: column-reverse
        }
        .apexcharts-tooltip-box>div {
            margin: 4px 0
        }
        .apexcharts-tooltip-box span.value {
            font-weight: 700
        }
        .apexcharts-tooltip-rangebar {
            padding: 5px 8px
        }
        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777
        }
        .apexcharts-tooltip-rangebar .series-name {
            font-weight: 700;
            display: block;
            margin-bottom: 5px
        }
        .apexcharts-xaxistooltip,
        .apexcharts-yaxistooltip {
            opacity: 0;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #eceff1;
            border: 1px solid #90a4ae
        }
        .apexcharts-xaxistooltip {
            padding: 9px 10px;
            transition: .15s ease all
        }
        .apexcharts-xaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, .7);
            border: 1px solid rgba(0, 0, 0, .5);
            color: #fff
        }
        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none
        }
        .apexcharts-xaxistooltip:after {
            border-color: transparent;
            border-width: 6px;
            margin-left: -6px
        }
        .apexcharts-xaxistooltip:before {
            border-color: transparent;
            border-width: 7px;
            margin-left: -7px
        }
        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%
        }
        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%
        }
        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #eceff1
        }
        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90a4ae
        }
        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after,
        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
            border-bottom-color: rgba(0, 0, 0, .5)
        }
        .apexcharts-xaxistooltip-top:after {
            border-top-color: #eceff1
        }
        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90a4ae
        }
        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after,
        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
            border-top-color: rgba(0, 0, 0, .5)
        }
        .apexcharts-xaxistooltip.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }
        .apexcharts-yaxistooltip {
            padding: 4px 10px
        }
        .apexcharts-yaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, .7);
            border: 1px solid rgba(0, 0, 0, .5);
            color: #fff
        }
        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none
        }
        .apexcharts-yaxistooltip:after {
            border-color: transparent;
            border-width: 6px;
            margin-top: -6px
        }
        .apexcharts-yaxistooltip:before {
            border-color: transparent;
            border-width: 7px;
            margin-top: -7px
        }
        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%
        }
        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%
        }
        .apexcharts-yaxistooltip-left:after {
            border-left-color: #eceff1
        }
        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90a4ae
        }
        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after,
        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
            border-left-color: rgba(0, 0, 0, .5)
        }
        .apexcharts-yaxistooltip-right:after {
            border-right-color: #eceff1
        }
        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90a4ae
        }
        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after,
        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
            border-right-color: rgba(0, 0, 0, .5)
        }
        .apexcharts-yaxistooltip.apexcharts-active {
            opacity: 1
        }
        .apexcharts-yaxistooltip-hidden {
            display: none
        }
        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: .15s ease all
        }
        .apexcharts-xcrosshairs.apexcharts-active,
        .apexcharts-ycrosshairs.apexcharts-active {
            opacity: 1;
            transition: .15s ease all
        }
        .apexcharts-ycrosshairs-hidden {
            opacity: 0
        }
        .apexcharts-selection-rect {
            cursor: move
        }
        .svg_select_shape {
            stroke-width: 1;
            stroke-dasharray: 10 10;
            stroke: black;
            stroke-opacity: 0.1;
            pointer-events: none;
            fill: none;
        }
        .svg_select_handle {
            stroke-width: 3;
            stroke: black;
            fill: none;
        }
        .svg_select_handle_r {
            cursor: e-resize;
        }
        .svg_select_handle_l {
            cursor: w-resize;
        }
        .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
            cursor: crosshair
        }
        .apexcharts-svg.apexcharts-zoomable.hovering-pan {
            cursor: move
        }
        .apexcharts-menu-icon,
        .apexcharts-pan-icon,
        .apexcharts-reset-icon,
        .apexcharts-selection-icon,
        .apexcharts-toolbar-custom-icon,
        .apexcharts-zoom-icon,
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6e8192;
            text-align: center
        }
        .apexcharts-menu-icon svg,
        .apexcharts-reset-icon svg,
        .apexcharts-zoom-icon svg,
        .apexcharts-zoomin-icon svg,
        .apexcharts-zoomout-icon svg {
            fill: #6e8192
        }
        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(.76)
        }
        .apexcharts-theme-dark .apexcharts-menu-icon svg,
        .apexcharts-theme-dark .apexcharts-pan-icon svg,
        .apexcharts-theme-dark .apexcharts-reset-icon svg,
        .apexcharts-theme-dark .apexcharts-selection-icon svg,
        .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomout-icon svg {
            fill: #f3f4f5
        }
        .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg {
            fill: #008ffb
        }
        .apexcharts-theme-light .apexcharts-menu-icon:hover svg,
        .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
        .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
        .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg {
            fill: #333
        }
        .apexcharts-menu-icon,
        .apexcharts-selection-icon {
            position: relative
        }
        .apexcharts-reset-icon {
            margin-left: 5px
        }
        .apexcharts-menu-icon,
        .apexcharts-reset-icon,
        .apexcharts-zoom-icon {
            transform: scale(.85)
        }
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            transform: scale(.7)
        }
        .apexcharts-zoomout-icon {
            margin-right: 3px
        }
        .apexcharts-pan-icon {
            transform: scale(.62);
            position: relative;
            left: 1px;
            top: 0
        }
        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6e8192;
            stroke-width: 2
        }
        .apexcharts-pan-icon.apexcharts-selected svg {
            stroke: #008ffb
        }
        .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
            stroke: #333
        }
        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0 6px 2px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }
        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: .15s ease all;
            pointer-events: none
        }
        .apexcharts-menu.apexcharts-menu-open {
            opacity: 1;
            pointer-events: all;
            transition: .15s ease all
        }
        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer
        }
        .apexcharts-theme-light .apexcharts-menu-item:hover {
            background: #eee
        }
        .apexcharts-theme-dark .apexcharts-menu {
            background: rgba(0, 0, 0, .7);
            color: #fff
        }
        @media screen and (min-width:768px) {
            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1
            }
        }
        .apexcharts-canvas .apexcharts-element-hidden,
        .apexcharts-datalabel.apexcharts-element-hidden,
        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }
        .apexcharts-hidden-element-shown {
            opacity: 1;
            transition: 0.25s ease all;
        }
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value,
        .apexcharts-datalabels,
        .apexcharts-pie-label {
            cursor: default;
            pointer-events: none
        }
        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: .3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease
        }
        .apexcharts-radialbar-label {
            cursor: pointer;
        }
        .apexcharts-annotation-rect,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-gridline,
        .apexcharts-line,
        .apexcharts-point-annotation-label,
        .apexcharts-radar-series path:not(.apexcharts-marker),
        .apexcharts-radar-series polygon,
        .apexcharts-toolbar svg,
        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-xaxis-annotation-label,
        .apexcharts-yaxis-annotation-label,
        .apexcharts-zoom-rect,
        .no-pointer-events {
            pointer-events: none
        }
        .apexcharts-tooltip-active .apexcharts-marker {
            transition: .15s ease all
        }
        .apexcharts-radar-series .apexcharts-yaxis {
            pointer-events: none;
        }
        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
            height: 100%;
            width: 100%;
            overflow: hidden
        }
        .contract-trigger:before,
        .resize-triggers,
        .resize-triggers>div {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0
        }
        .resize-triggers>div {
            height: 100%;
            width: 100%;
            background: #eee;
            overflow: auto
        }
        .contract-trigger:before {
            overflow: hidden;
            width: 200%;
            height: 200%
        }
        .apexcharts-bar-goals-markers {
            pointer-events: none
        }
        .apexcharts-bar-shadows {
            pointer-events: none
        }
        .apexcharts-rangebar-goals-markers {
            pointer-events: none
        }
        .apexcharts-disable-transitions * {
            transition: none !important;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <button class="nav-link active">Abbasov Əli Yaqub</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link">Əmrlər</button>
                </li>
            </ul>
            <button class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#kadrModal">
                <i class="bi bi-plus-circle me-1"></i> Əlavə et
            </button>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <div class="order-row d-flex justify-content-between align-items-center px-3 py-2 mb-2 bg-light border">
            <span class="text-primary">Əmr n-102</span>
            <span class="text-danger fw-bold btn-delete" style="cursor:pointer;">×</span>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="kadrModal" tabindex="-1" aria-labelledby="kadrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="kadrModalLabel">Yenisini yarat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bağla"></button>
                    </div>
                    <div class="modal-body">
                        <form id="kadrForm">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="card assignees-card shadow-sm border-primary-subtle">
                                        <div class="card-header d-flex justify-content-between align-items-center py-2">
                                            <span class="fw-semibold">
                                                <i class="bi bi-file-earmark-ruled me-2"></i>Əmr
                                            </span>
                                            <button type="button" id="btnAddOrder" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-plus-lg me-1"></i>Sətir əlavə et
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div id="ordersWrap" class="vstack gap-3">
                                                <div class="d-flex align-items-center gap-2 assignee-row">
                                                    <input type="file" name="orders[]"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                Lazım olduqda bir neçə əmr faylı yükləyə bilərsiniz.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Bağla</button>
                        <button type="submit" form="kadrForm" class="btn btn-primary">Yadda saxla</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAddOrder = document.getElementById('btnAddOrder');
            const ordersWrap = document.getElementById('ordersWrap');
            btnAddOrder.addEventListener('click', () => {
                const row = document.createElement('div');
                row.className = 'd-flex align-items-center gap-2 assignee-row';
                row.innerHTML = `
            <input type="file" name="orders[]" class="form-control form-control-sm">
            <button type="button" class="btn btn-sm btn-outline-danger btnRemove">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
                ordersWrap.appendChild(row);
                // Bu sətirin "x" düyməsi işləsin
                const btnRemove = row.querySelector('.btnRemove');
                btnRemove.addEventListener('click', () => {
                    row.remove();
                });
            });
        });
    </script>
    <script>
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("btn-delete")) {
                const row = e.target.closest(".order-row");
                Swal.fire({
                    title: "Silmək istəyirsiniz?",
                    text: "Bu əmri silmək istədiyinizə əminsiniz?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Bəli, sil!",
                    cancelButtonText: "Ləğv et"
                }).then((result) => {
                    if (result.isConfirmed) {
                        row.remove();
                        Swal.fire({
                            title: "Silindi!",
                            text: "Əmr uğurla silindi.",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    </script>
@endsection
