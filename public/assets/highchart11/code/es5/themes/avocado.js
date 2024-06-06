/**
 * Highcharts JS v11.2.0 (2023-10-30)
 *
 * (c) 2009-2021 Highsoft AS
 *
 * License: www.highcharts.com/license
 */!function(o){"object"==typeof module&&module.exports?(o.default=o,module.exports=o):"function"==typeof define&&define.amd?define("highcharts/themes/avocado",["highcharts"],function(e){return o(e),o.Highcharts=e,o}):o("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(o){"use strict";var e=o?o._modules:{};function t(o,e,t,n){o.hasOwnProperty(e)||(o[e]=n.apply(null,t),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:o[e]}})))}t(e,"Extensions/Themes/Avocado.js",[e["Core/Defaults.js"]],function(o){var e,t,n=o.setOptions;return(e=t||(t={})).options={colors:["#F3E796","#95C471","#35729E","#251735"],colorAxis:{maxColor:"#05426E",minColor:"#F3E796"},plotOptions:{map:{nullColor:"#FCFEFE"}},navigator:{maskFill:"rgba(170, 205, 170, 0.5)",series:{color:"#95C471",lineColor:"#35729E"}}},e.apply=function(){n(e.options)},t}),t(e,"masters/themes/avocado.src.js",[e["Core/Globals.js"],e["Extensions/Themes/Avocado.js"]],function(o,e){o.theme=e.options,e.apply()})});//# sourceMappingURL=avocado.js.map