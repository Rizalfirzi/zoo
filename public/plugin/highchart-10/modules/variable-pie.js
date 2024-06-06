/*
 Highcharts JS v10.3.3 (2023-01-20)

 Variable Pie module for Highcharts

 (c) 2010-2021 Grzegorz Blachliski

 License: www.highcharts.com/license
*/
(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/modules/variable-pie",["highcharts"],function(e){a(e);a.Highcharts=e;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function e(a,b,e,h){a.hasOwnProperty(b)||(a[b]=h.apply(null,e),"function"===typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:b,module:a[b]}})))}a=a?a._modules:{};
e(a,"Series/VariablePie/VariablePieSeries.js",[a["Core/Series/SeriesRegistry.js"],a["Core/Utilities.js"]],function(a,b){var e=this&&this.__extends||function(){var a=function(b,c){a=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(c,a){c.__proto__=a}||function(c,a){for(var b in a)a.hasOwnProperty(b)&&(c[b]=a[b])};return a(b,c)};return function(b,c){function r(){this.constructor=b}a(b,c);b.prototype=null===c?Object.create(c):(r.prototype=c.prototype,new r)}}(),h=a.seriesTypes.pie,v=b.arrayMax,
w=b.arrayMin,y=b.clamp,z=b.extend,A=b.fireEvent,B=b.merge,m=b.pick;b=function(a){function b(){var c=null!==a&&a.apply(this,arguments)||this;c.data=void 0;c.options=void 0;c.points=void 0;c.radii=void 0;return c}e(b,a);b.prototype.calculateExtremes=function(){var c=this.chart,a=this.options;var b=this.zData;var e=Math.min(c.plotWidth,c.plotHeight)-2*(a.slicedOffset||0),k={};c=this.center||this.getCenter();["minPointSize","maxPointSize"].forEach(function(c){var b=a[c],q=/%$/.test(b);b=parseInt(b,10);
k[c]=q?e*b/100:2*b});this.minPxSize=c[3]+k.minPointSize;this.maxPxSize=y(c[2],c[3]+k.minPointSize,k.maxPointSize);b.length&&(c=m(a.zMin,w(b.filter(this.zValEval))),b=m(a.zMax,v(b.filter(this.zValEval))),this.getRadii(c,b,this.minPxSize,this.maxPxSize))};b.prototype.getRadii=function(c,b,a,e){var k=0,q=this.zData,r=q.length,l=[],h="radius"!==this.options.sizeBy,m=b-c;for(k;k<r;k++){var g=this.zValEval(q[k])?q[k]:c;g<=c?g=a/2:g>=b?g=e/2:(g=0<m?(g-c)/m:.5,h&&(g=Math.sqrt(g)),g=Math.ceil(a+g*(e-a))/2);
l.push(g)}this.radii=l};b.prototype.redraw=function(){this.center=null;a.prototype.redraw.apply(this,arguments)};b.prototype.translate=function(c){this.generatePoints();var b=0,a=this.options,e=a.slicedOffset,k=e+(a.borderWidth||0),h=a.startAngle||0,t=Math.PI/180*(h-90),l=Math.PI/180*(m(a.endAngle,h+360)-90);h=l-t;var x=this.points,v=a.dataLabels.distance;a=a.ignoreHiddenPoint;var g=x.length;this.startAngleRad=t;this.endAngleRad=l;this.calculateExtremes();c||(this.center=c=this.getCenter());for(l=
0;l<g;l++){var f=x[l];var n=this.radii[l];f.labelDistance=m(f.options.dataLabels&&f.options.dataLabels.distance,v);this.maxLabelDistance=Math.max(this.maxLabelDistance||0,f.labelDistance);var d=t+b*h;if(!a||f.visible)b+=f.percentage/100;var p=t+b*h;f.shapeType="arc";f.shapeArgs={x:c[0],y:c[1],r:n,innerR:c[3]/2,start:Math.round(1E3*d)/1E3,end:Math.round(1E3*p)/1E3};d=(p+d)/2;d>1.5*Math.PI?d-=2*Math.PI:d<-Math.PI/2&&(d+=2*Math.PI);f.slicedTranslation={translateX:Math.round(Math.cos(d)*e),translateY:Math.round(Math.sin(d)*
e)};var u=Math.cos(d)*c[2]/2;var w=Math.sin(d)*c[2]/2;p=Math.cos(d)*n;n*=Math.sin(d);f.tooltipPos=[c[0]+.7*u,c[1]+.7*w];f.half=d<-Math.PI/2||d>Math.PI/2?1:0;f.angle=d;u=Math.min(k,f.labelDistance/5);f.labelPosition={natural:{x:c[0]+p+Math.cos(d)*f.labelDistance,y:c[1]+n+Math.sin(d)*f.labelDistance},"final":{},alignment:f.half?"right":"left",connectorPosition:{breakAt:{x:c[0]+p+Math.cos(d)*u,y:c[1]+n+Math.sin(d)*u},touchingSliceAt:{x:c[0]+p,y:c[1]+n}}}}A(this,"afterTranslate")};b.prototype.zValEval=
function(a){return"number"!==typeof a||isNaN(a)?null:!0};b.defaultOptions=B(h.defaultOptions,{minPointSize:"10%",maxPointSize:"100%",zMin:void 0,zMax:void 0,sizeBy:"area",tooltip:{pointFormat:'<span style="color:{point.color}">\u25cf</span> {series.name}<br/>Value: {point.y}<br/>Size: {point.z}<br/>'}});return b}(h);z(b.prototype,{pointArrayMap:["y","z"],parallelArrays:["x","y","z"]});a.registerSeriesType("variablepie",b);"";"";return b});e(a,"masters/modules/variable-pie.src.js",[],function(){})});
//# sourceMappingURL=variable-pie.js.map