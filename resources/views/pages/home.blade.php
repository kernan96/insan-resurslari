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
    <style>
        .post-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            margin-bottom: 15px;
        }
        .post-item:last-child {
            border-bottom: none;
        }
        .post-item img {
            width: 60px;
            border-radius: 50%;
            float: left;
            margin-right: 15px;
            object-fit: cover;
        }
        .post-item h4 {
            margin: 0 0 5px 0;
            font-size: 1.1rem;
        }
        .post-item p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .comment-section {
            margin-top: 15px;
            padding-left: 15px;
        }
        .comment {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-left: 3px solid #0d6efd;
        }
        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .comment-author {
            font-weight: bold;
            color: #333;
        }
        .comment-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .comment-text {
            margin: 0;
        }
        .comment-btn {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 5px;
            border-radius: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            margin-right: 5px;
            gap: 5px
        }
        .comment-btn:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
        .like-section {
            display: flex;
            align-items: center;
        }
        .like-btn {
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            margin-right: 5px;
        }
        .like-btn:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
        .like-btn.liked {
            color: #0d6efd;
        }
        .like-count {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .add-comment-form {
            margin-top: 20px;
            padding-left: 15px;
        }
        .comment-input-group {
            display: flex;
            gap: 10px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-primary {
            border-radius: 20px;
            padding: 8px 20px;
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .fake-comments-title {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 20px;
            padding-left: 15px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .post-actions {
            display: flex;
            align-items: center;
            gap: 20px;
            /* aralarındakı məsafə */
        }
        .comment-section {
            display: none;
        }
        .comment-section.active {
            display: block;
        }
    </style>
@endsection
@section('content')
    <main class="main blurred" id="main">
        <style>
            .post-item {
                border-bottom: 1px solid #eee;
                padding: 15px 0;
                margin-bottom: 15px;
            }
            .post-item:last-child {
                border-bottom: none;
            }
            .post-item img {
                width: 60px;
                border-radius: 50%;
                float: left;
                margin-right: 15px;
                object-fit: cover;
            }
            .post-item h4 {
                margin: 0 0 5px 0;
                font-size: 1.1rem;
            }
            .post-item p {
                margin: 0;
                color: #6c757d;
                font-size: 0.9rem;
            }
            .comment-section {
                margin-top: 15px;
                padding-left: 15px;
            }
            .comment {
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 10px 15px;
                margin-bottom: 10px;
                border-left: 3px solid #0d6efd;
            }
            .comment-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 5px;
            }
            .comment-author {
                font-weight: bold;
                color: #333;
            }
            .comment-time {
                font-size: 0.8rem;
                color: #6c757d;
            }
            .comment-text {
                margin: 0;
            }
            .comment-btn {
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
                padding: 5px;
                border-radius: 20%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s;
                margin-right: 5px;
                gap: 5px
            }
            .comment-btn:hover {
                background-color: rgba(13, 110, 253, 0.1);
            }
            .like-section {
                display: flex;
                align-items: center;
            }
            .like-btn {
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
                padding: 5px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s;
                margin-right: 5px;
            }
            .like-btn:hover {
                background-color: rgba(13, 110, 253, 0.1);
            }
            .like-btn.liked {
                color: #0d6efd;
            }
            .like-count {
                font-size: 0.9rem;
                color: #6c757d;
            }
            .add-comment-form {
                margin-top: 20px;
                padding-left: 15px;
            }
            .comment-input-group {
                display: flex;
                gap: 10px;
            }
            .form-control {
                border-radius: 20px;
            }
            .btn-primary {
                border-radius: 20px;
                padding: 8px 20px;
                background-color: #0d6efd;
                border: none;
            }
            .btn-primary:hover {
                background-color: #0b5ed7;
            }
            .fake-comments-title {
                font-size: 0.9rem;
                color: #6c757d;
                margin-top: 20px;
                padding-left: 15px;
                border-top: 1px solid #eee;
                padding-top: 15px;
            }
            .post-actions {
                display: flex;
                align-items: center;
                gap: 20px;
                /* aralarındakı məsafə */
            }
            .comment-section {
                display: none;
            }
            .comment-section.active {
                display: block;
            }
        </style>
        <div class="pagetitle">
            <h1>İdarə paneli</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Ana səhifə</a></li>
                    <li class="breadcrumb-item active">İdarə paneli</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" data-bs-toggle="dropdown" href="#"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Bugün</a></li>
                                        <li><a class="dropdown-item" href="#">Bu ay</a></li>
                                        <li><a class="dropdown-item" href="#">Bu il</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Müraciətlər <span>| Bugün</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>140</h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">artım</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="filter">
                                    <a class="icon" data-bs-toggle="dropdown" href="#"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Bugün</a></li>
                                        <li><a class="dropdown-item" href="#">Bu ay</a></li>
                                        <li><a class="dropdown-item" href="#">Bu il</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Müsahibələr <span>| Bu ay</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>30</h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">artım</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="filter">
                                    <a class="icon" data-bs-toggle="dropdown" href="#"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Bugün</a></li>
                                        <li><a class="dropdown-item" href="#">Bu ay</a></li>
                                        <li><a class="dropdown-item" href="#">Bu il</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">İşə qəbul <span>| Bu il</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>5</h6>
                                            <span class="text-danger small pt-1 fw-bold">3%</span> <span
                                                class="text-muted small pt-2 ps-1">artım</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Bu gün başlayan və bitən məzuniyyətlər <span>| Bugün</span>
                                    </h5>
                                    <div
                                        class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                        <div class="datatable-container">
                                            <table class="table table-borderless datatable datatable-table">
                                                <thead>
                                                    <tr>
                                                        <th data-sortable="true" scope="col"
                                                            style="width: 23.61546499477534%;"><button
                                                                class="datatable-sorter">İşçi</button></th>
                                                        <th data-sortable="true" scope="col"
                                                            style="width: 39.60292580982236%;"><button
                                                                class="datatable-sorter">Məzuniyyətin növü</button></th>
                                                        <th data-sortable="true" scope="col"
                                                            style="width: 11.076280041797283%;"><button
                                                                class="datatable-sorter">Tarix</button></th>
                                                        <th class="red" data-sortable="true" scope="col"
                                                            style="width: 14.942528735632186%;"><button
                                                                class="datatable-sorter">Status</button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-index="0">
                                                        <td>Əli Məmmədov</td>
                                                        <td>Təhsil məzuniyyəti</td>
                                                        <td>24.08-29.09</td>
                                                        <td class="green"><span class="badge bg-success">Başlayır</span>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="1">
                                                        <td>Günel Hüseynli</td>
                                                        <td>İllik məzuniyyəti</td>
                                                        <td>24.08-29.09</td>
                                                        <td class="green"><span class="badge bg-warning">Bitir</span>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="2">
                                                        <td>Rəşad Quliyev</td>
                                                        <td>İllik məzuniyyəti</td>
                                                        <td>24.08-29.09</td>
                                                        <td class="green"><span class="badge bg-success">Başlayır</span>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="4">
                                                        <td>Nigar Məmmədova</td>
                                                        <td>Təhsil məzuniyyəti</td>
                                                        <td>24.08-29.09</td>
                                                        <td class="green"><span class="badge bg-success">Başlayır</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="filter">
                                    <a class="icon" data-bs-toggle="dropdown" href="#"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Bugün</a></li>
                                        <li><a class="dropdown-item" href="#">Bu ay</a></li>
                                    </ul>
                                </div>
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Müddəti bitmək üzrə olan müqavilələr <span>| 30 gün</span></h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">İşçi</th>
                                                <th scope="col">Şöbə</th>
                                                <th scope="col">Bitmə tarixi</th>
                                                <th scope="col">Qalan gün</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Əli Məmmədov</th>
                                                <td>Rəqəmsal İnkişaf və İnnovasiya Şöbəsi</td>
                                                <td>12.09.2025</td>
                                                <td>16</td>
                                                <td>Yaxınlaşır</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Günel Hüseynli</th>
                                                <td>Texnoloji İnkişaf Şöbəsi</td>
                                                <td>03.09.2025</td>
                                                <td>7</td>
                                                <td>Təcili</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nicat Əliyev</th>
                                                <td>Hüquqşünas</td>
                                                <td>29.09.2025</td>
                                                <td>33</td>
                                                <td>İzləmədə</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Qurumlarda İşçi Sayı<span>| Ümumi</span></h5>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">640</div>
                                    <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                                    <div class="activity-content"> Ümumi işçi sayı
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">90</div>
                                    <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                                    <div class="activity-content">
                                        Rəqəmsal İnkişaf və Nəqliyyat Nazirliyi
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">150</div>
                                    <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                                    <div class="activity-content">
                                        Naxçıvan Poçt və Telekomunikasiya Mərkəzi MMC
                                    </div>
                                </div>
                                <div class="activity-item d-flex">
                                    <div class="activite-label">30</div>
                                    <i class="bi bi-circle-fill activity-badge text-warning align-self-start"></i>
                                    <div class="activity-content">
                                        Naxçıvan Poçt MMC
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="filter">
                            <a class="icon" data-bs-toggle="dropdown" href="#"><i
                                    class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">Bugün</a></li>
                                <li><a class="dropdown-item" href="#">Bu ay</a></li>
                            </ul>
                        </div>
                        <div class="card-body pb-2">
                            <h5 class="card-title">Doğum günü olanlar<span>| Bugün</span></h5>
                            <div class="news">
                                <div class="post-item clearfix">
                                    <img alt="Rəşad Quliyev" src="{{asset('files/img/noprofile.jpg')}}">
                                    <h4 style="margin: 0;"><a href="#">Rəşad Quliyev</a></h4>
                                    <p class="mb-1">Daxili nəzarət və audit sektoru - 39 yaş</p>
                                    <div class="post-actions">
                                        <div class="like-section">
                                            <button class="like-btn" data-post="1">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                            <span class="like-count" data-post="1">18</span>
                                        </div>
                                        <div class="comment-button-section">
                                            <button class="comment-btn" comment-button="1">
                                                <i class="bi bi-chat"></i>
                                                Şərh
                                            </button>
                                        </div>
                                    </div>
                                    <div class="add-comment-form">
                                        <div class="comment-input-group">
                                            <input type="text" class="form-control comment-input"
                                                placeholder="Şərh...">
                                            <button class="btn btn-primary add-comment-btn">Göndər</button>
                                        </div>
                                    </div>
                                    <div class="comment-section" comment-section-id="1">
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Leyla Əliyeva</span>
                                                <span class="comment-time">2 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Ad günün mübarək! Sağlamlıq, uğur və xoşbəxtlik
                                                diləyirəm!</p>
                                        </div>
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Kamran Əliyev</span>
                                                <span class="comment-time">5 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Rəşad, doğum günün mübarək! Yeni yaşında sənə bütün
                                                arzularının
                                                reallaşmasını diləyirəm!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-item clearfix">
                                    <img alt="Hikmət Quliyev" src="{{asset('files/img/noprofile.jpg')}}">
                                    <h4><a href="#">Hikmət Quliyev</a></h4>
                                    <p class="mb-1">İnsan resursları, hüquq, sənədlərlə və müraciətlərlə iş şöbəsi - 36
                                        yaş</p>
                                    <div class="post-actions">
                                        <div class="like-section">
                                            <button class="like-btn" data-post="2">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                            <span class="like-count" data-post="2">18</span>
                                        </div>
                                        <div class="comment-button-section">
                                            <button class="comment-btn" comment-button="2">
                                                <i class="bi bi-chat"></i>
                                                Şərh
                                            </button>
                                        </div>
                                    </div>
                                    <div class="add-comment-form">
                                        <div class="comment-input-group">
                                            <input type="text" class="form-control comment-input"
                                                placeholder="Şərh...">
                                            <button class="btn btn-primary add-comment-btn">Göndər</button>
                                        </div>
                                    </div>
                                    <div class="comment-section" comment-section-id="2">
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Aysel Hüseynova</span>
                                                <span class="comment-time">3 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Ad günün mübarək, Hikmət m! Uğurların daim səni
                                                müşayiət etsin!</p>
                                        </div>
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Fərid Əhmədov</span>
                                                <span class="comment-time">7 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Doğum günün mübarək! Yeni yaşında sənə sağlamlıq,
                                                sevgi və bolluq
                                                diləyirəm!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-item clearfix">
                                    <img alt="Kənan Hüseynəliyev" src="{{asset('files/img/noprofile.jpg')}}">
                                    <h4><a href="#">Kənan Hüseynəliyev</a></h4>
                                    <p class="mb-1">Rəqəmsal inkişaf və innovasiya şöbəsi - 22 yaş</p>
                                    <div class="post-actions">
                                        <div class="like-section">
                                            <button class="like-btn" data-post="3">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                            <span class="like-count" data-post="3">18</span>
                                        </div>
                                        <div class="comment-button-section">
                                            <button class="comment-btn" comment-button="3">
                                                <i class="bi bi-chat"></i>
                                                Şərh
                                            </button>
                                        </div>
                                    </div>
                                    <div class="add-comment-form">
                                        <div class="comment-input-group">
                                            <input type="text" class="form-control comment-input"
                                                placeholder="Şərh...">
                                            <button class="btn btn-primary add-comment-btn">Göndər</button>
                                        </div>
                                    </div>
                                    <div class="comment-section" comment-section-id="3">
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Samir Həsənov</span>
                                                <span class="comment-time">1 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Kənan, doğum günün mübarək! Uzun ömür, sağlamlıq və
                                                uğurlar diləyirəm!</p>
                                        </div>
                                        <div class="comment">
                                            <div class="comment-header">
                                                <span class="comment-author">Nərminə Rzayeva</span>
                                                <span class="comment-time">4 saat əvvəl</span>
                                            </div>
                                            <p class="comment-text">Ad günün mübarək! Yeni yaşında sənə xoşbəxtlik və
                                                bütün arzularının
                                                reallaşmasını diləyirəm!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js')
    <script>
        document.addEventListener("click", function(e) {
            const btn = e.target.closest(".comment-btn");
            if (!btn) return;
            const id = btn.getAttribute("comment-button");
            const section = document.querySelector(
                `.comment-section[comment-section-id="${id}"]`
            );
            if (!section) return;
            section.classList.toggle("active");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fakeComments = [{
                author: "İlham Hüseynov",
                text: "Kənan, doğum günün mübarək! Uzun ömür və sağlamlıq diləyirəm!"
            },
            {
                author: "Aydan Əliyeva",
                text: "Ad günün mübarək! Yeni yaşında sənə bütün arzularının reallaşmasını diləyirəm!"
            },
            {
                author: "Elçin Rəhimov",
                text: "Kənan, təbrik edirəm! Sağlamlıq və uğurlar diləyirəm!"
            },
            {
                author: "Zəhra Qurbanova",
                text: "Doğum günün mübarək! Xoşbəxtlik və sevgi səni həmişə müşayiət etsin!"
            },
            {
                author: "Vüqar Səfərov",
                text: "Kənan, ad günün mübarək! Yeni yaşında sənə bolluq və firavanlıq diləyirəm!"
            }
        ];
        document.addEventListener('DOMContentLoaded', function() {
            loadFakeComments();
            setupLikeButtons();
            setupCommentButtons();
        });
        function loadFakeComments() {
            const commentSection = document.querySelectorAll('.post-item')[2].querySelector('.comment-section');
            fakeComments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.className = 'comment';
                commentElement.innerHTML = `
                    <div class="comment-header">
                        <span class="comment-author">${comment.author}</span>
                        <span class="comment-time">${Math.floor(Math.random() * 24)} saat əvvəl</span>
                    </div>
                    <p class="comment-text">${comment.text}</p>
                `;
                commentSection.appendChild(commentElement);
            });
        }
        function setupLikeButtons() {
            const likeButtons = document.querySelectorAll('.like-btn');
            likeButtons.forEach(button => {
                const postId = button.getAttribute('data-post');
                const isLiked = localStorage.getItem(`post-${postId}-liked`) === 'true';
                if (isLiked) {
                    button.classList.add('liked');
                    button.innerHTML = '<i class="bi bi-heart-fill"></i>';
                }
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post');
                    const likeCountElement = document.querySelector(`.like-count[data-post="${postId}"]`);
                    if (!likeCountElement) return;
                    let likeCount = parseInt(likeCountElement.textContent);
                    if (this.classList.contains('liked')) {
                        this.classList.remove('liked');
                        this.innerHTML = '<i class="bi bi-heart"></i>';
                        likeCount--;
                        localStorage.setItem(`post-${postId}-liked`, 'false');
                    } else {
                        this.classList.add('liked');
                        this.innerHTML = '<i class="bi bi-heart-fill"></i>';
                        likeCount++;
                        localStorage.setItem(`post-${postId}-liked`, 'true');
                    }
                    likeCountElement.textContent = likeCount;
                });
            });
        }
        function setupCommentButtons() {
            const commentButtons = document.querySelectorAll('.add-comment-btn');
            if (commentButtons.length === 0) {
                console.log("Yorum butonları tapılmadı!");
                return;
            }
            commentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const postItem = this.closest('.post-item');
                    if (!postItem) return;
                    const commentInput = postItem.querySelector('.comment-input');
                    if (!commentInput) return;
                    const commentText = commentInput.value.trim();
                    if (commentText) {
                        const commentSection = postItem.querySelector('.comment-section');
                        if (!commentSection) return;
                        const commentElement = document.createElement('div');
                        commentElement.className = 'comment';
                        const now = new Date();
                        const hours = now.getHours().toString().padStart(2, '0');
                        const minutes = now.getMinutes().toString().padStart(2, '0');
                        const timeString = `${hours}:${minutes}`;
                        const userNameElement = postItem.querySelector('h4 a');
                        const userName = userNameElement ? userNameElement.textContent : "İstifadəçi";
                        commentElement.innerHTML = `
              <div class="comment-header">
                <span class="comment-author">Əli Məmmədov</span>
                <span class="comment-time">${timeString}</span>
              </div>
              <p class="comment-text">${commentText}</p>
            `;
                        commentSection.prepend(commentElement);
                        commentSection.classList.add("active");
                        commentInput.value = '';
                        const fakeCommentsTitle = postItem.querySelector('.fake-comments-title');
                        if (fakeCommentsTitle) {
                            commentSection.appendChild(fakeCommentsTitle);
                        }
                    }
                });
            });
            const commentInputs = document.querySelectorAll('.comment-input');
            commentInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const postItem = this.closest('.post-item');
                        if (!postItem) return;
                        const sendButton = postItem.querySelector('.add-comment-btn');
                        if (sendButton) {
                            sendButton.click();
                        }
                    }
                });
            });
        }
    </script>
@endsection
