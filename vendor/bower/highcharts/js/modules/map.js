/*
 Highmaps JS v6.0.3 (2017-11-14)
 Highmaps as a plugin for Highcharts 4.1.x or Highstock 2.1.x (x being the patch version of this file)

 (c) 2011-2017 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(x){"object"===typeof module&&module.exports?module.exports=x:x(Highcharts)})(function(x){(function(a){var h=a.Axis,m=a.each,f=a.pick;a=a.wrap;a(h.prototype,"getSeriesExtremes",function(a){var e=this.isXAxis,p,v,h=[],l;e&&m(this.series,function(a,b){a.useMapGeometry&&(h[b]=a.xData,a.xData=[])});a.call(this);e&&(p=f(this.dataMin,Number.MAX_VALUE),v=f(this.dataMax,-Number.MAX_VALUE),m(this.series,function(a,b){a.useMapGeometry&&(p=Math.min(p,f(a.minX,p)),v=Math.max(v,f(a.maxX,v)),a.xData=h[b],
l=!0)}),l&&(this.dataMin=p,this.dataMax=v))});a(h.prototype,"setAxisTranslation",function(a){var e=this.chart,p=e.plotWidth/e.plotHeight,e=e.xAxis[0],f;a.call(this);"yAxis"===this.coll&&void 0!==e.transA&&m(this.series,function(a){a.preserveAspectRatio&&(f=!0)});if(f&&(this.transA=e.transA=Math.min(this.transA,e.transA),a=p/((e.max-e.min)/(this.max-this.min)),a=1>a?this:e,p=(a.max-a.min)*a.transA,a.pixelPadding=a.len-p,a.minPixelPadding=a.pixelPadding/2,p=a.fixTo)){p=p[1]-a.toValue(p[0],!0);p*=a.transA;
if(Math.abs(p)>a.minPixelPadding||a.min===a.dataMin&&a.max===a.dataMax)p=0;a.minPixelPadding-=p}});a(h.prototype,"render",function(a){a.call(this);this.fixTo=null})})(x);(function(a){var h=a.Axis,m=a.Chart,f=a.color,e,t=a.each,p=a.extend,v=a.isNumber,u=a.Legend,l=a.LegendSymbolMixin,c=a.noop,b=a.merge,k=a.pick,r=a.wrap;a.ColorAxis||(e=a.ColorAxis=function(){this.init.apply(this,arguments)},p(e.prototype,h.prototype),p(e.prototype,{defaultColorAxisOptions:{lineWidth:0,minPadding:0,maxPadding:0,gridLineWidth:1,
tickPixelInterval:72,startOnTick:!0,endOnTick:!0,offset:0,marker:{animation:{duration:50},width:.01},labels:{overflow:"justify",rotation:0},minColor:"#e6ebf5",maxColor:"#003399",tickLength:5,showInLegend:!0},keepProps:["legendGroup","legendItemHeight","legendItemWidth","legendItem","legendSymbol"].concat(h.prototype.keepProps),init:function(a,g){var d="vertical"!==a.options.legend.layout,n;this.coll="colorAxis";n=b(this.defaultColorAxisOptions,{side:d?2:1,reversed:!d},g,{opposite:!d,showEmpty:!1,
title:null});h.prototype.init.call(this,a,n);g.dataClasses&&this.initDataClasses(g);this.initStops();this.horiz=d;this.zoomEnabled=!1;this.defaultLegendLength=200},initDataClasses:function(a){var n,d=0,q=this.chart.options.chart.colorCount,w=this.options,c=a.dataClasses.length;this.dataClasses=n=[];this.legendItems=[];t(a.dataClasses,function(a,g){a=b(a);n.push(a);"category"===w.dataClassColor?(a.colorIndex=d,d++,d===q&&(d=0)):a.color=f(w.minColor).tweenTo(f(w.maxColor),2>c?.5:g/(c-1))})},setTickPositions:function(){if(!this.dataClasses)return h.prototype.setTickPositions.call(this)},
initStops:function(){this.stops=this.options.stops||[[0,this.options.minColor],[1,this.options.maxColor]];t(this.stops,function(a){a.color=f(a[1])})},setOptions:function(a){h.prototype.setOptions.call(this,a);this.options.crosshair=this.options.marker},setAxisSize:function(){var a=this.legendSymbol,g=this.chart,d=g.options.legend||{},q,b;a?(this.left=d=a.attr("x"),this.top=q=a.attr("y"),this.width=b=a.attr("width"),this.height=a=a.attr("height"),this.right=g.chartWidth-d-b,this.bottom=g.chartHeight-
q-a,this.len=this.horiz?b:a,this.pos=this.horiz?d:q):this.len=(this.horiz?d.symbolWidth:d.symbolHeight)||this.defaultLegendLength},normalizedValue:function(a){this.isLog&&(a=this.val2lin(a));return 1-(this.max-a)/(this.max-this.min||1)},toColor:function(a,g){var d=this.stops,q,b,n=this.dataClasses,c,k;if(n)for(k=n.length;k--;){if(c=n[k],q=c.from,d=c.to,(void 0===q||a>=q)&&(void 0===d||a<=d)){g&&(g.dataClass=k,g.colorIndex=c.colorIndex);break}}else{a=this.normalizedValue(a);for(k=d.length;k--&&!(a>
d[k][0]););q=d[k]||d[k+1];d=d[k+1]||q;a=1-(d[0]-a)/(d[0]-q[0]||1);b=q.color.tweenTo(d.color,a)}return b},getOffset:function(){var a=this.legendGroup,g=this.chart.axisOffset[this.side];a&&(this.axisParent=a,h.prototype.getOffset.call(this),this.added||(this.added=!0,this.labelLeft=0,this.labelRight=this.width),this.chart.axisOffset[this.side]=g)},setLegendColor:function(){var a,g=this.reversed;a=g?1:0;g=g?0:1;a=this.horiz?[a,0,g,0]:[0,g,0,a];this.legendColor={linearGradient:{x1:a[0],y1:a[1],x2:a[2],
y2:a[3]},stops:this.stops}},drawLegendSymbol:function(a,g){var d=a.padding,q=a.options,b=this.horiz,c=k(q.symbolWidth,b?this.defaultLegendLength:12),n=k(q.symbolHeight,b?12:this.defaultLegendLength),l=k(q.labelPadding,b?16:30),q=k(q.itemDistance,10);this.setLegendColor();g.legendSymbol=this.chart.renderer.rect(0,a.baseline-11,c,n).attr({zIndex:1}).add(g.legendGroup);this.legendItemWidth=c+d+(b?q:l);this.legendItemHeight=n+d+(b?l:0)},setState:c,visible:!0,setVisible:c,getSeriesExtremes:function(){var a=
this.series,b=a.length;this.dataMin=Infinity;for(this.dataMax=-Infinity;b--;)void 0!==a[b].valueMin&&(this.dataMin=Math.min(this.dataMin,a[b].valueMin),this.dataMax=Math.max(this.dataMax,a[b].valueMax))},drawCrosshair:function(a,b){var d=b&&b.plotX,q=b&&b.plotY,c,g=this.pos,k=this.len;b&&(c=this.toPixels(b[b.series.colorKey]),c<g?c=g-2:c>g+k&&(c=g+k+2),b.plotX=c,b.plotY=this.len-c,h.prototype.drawCrosshair.call(this,a,b),b.plotX=d,b.plotY=q,this.cross&&this.cross.addClass("highcharts-coloraxis-marker").add(this.legendGroup))},
getPlotLinePath:function(a,b,d,q,c){return v(c)?this.horiz?["M",c-4,this.top-6,"L",c+4,this.top-6,c,this.top,"Z"]:["M",this.left,c,"L",this.left-6,c+6,this.left-6,c-6,"Z"]:h.prototype.getPlotLinePath.call(this,a,b,d,q)},update:function(a,c){var d=this.chart,q=d.legend;t(this.series,function(a){a.isDirtyData=!0});a.dataClasses&&q.allItems&&(t(q.allItems,function(a){a.isDataClass&&a.legendGroup&&a.legendGroup.destroy()}),d.isDirtyLegend=!0);d.options[this.coll]=b(this.userOptions,a);h.prototype.update.call(this,
a,c);this.legendItem&&(this.setLegendColor(),q.colorizeItem(this,!0))},remove:function(){this.legendItem&&this.chart.legend.destroyItem(this);h.prototype.remove.call(this)},getDataClassLegendSymbols:function(){var b=this,g=this.chart,d=this.legendItems,q=g.options.legend,k=q.valueDecimals,r=q.valueSuffix||"",e;d.length||t(this.dataClasses,function(q,n){var w=!0,z=q.from,f=q.to;e="";void 0===z?e="\x3c ":void 0===f&&(e="\x3e ");void 0!==z&&(e+=a.numberFormat(z,k)+r);void 0!==z&&void 0!==f&&(e+=" - ");
void 0!==f&&(e+=a.numberFormat(f,k)+r);d.push(p({chart:g,name:e,options:{},drawLegendSymbol:l.drawRectangle,visible:!0,setState:c,isDataClass:!0,setVisible:function(){w=this.visible=!w;t(b.series,function(a){t(a.points,function(a){a.dataClass===n&&a.setVisible(w)})});g.legend.colorizeItem(this,w)}},q))});return d},name:""}),t(["fill","stroke"],function(b){a.Fx.prototype[b+"Setter"]=function(){this.elem.attr(b,f(this.start).tweenTo(f(this.end),this.pos),null,!0)}}),r(m.prototype,"getAxes",function(a){var b=
this.options.colorAxis;a.call(this);this.colorAxis=[];b&&new e(this,b)}),r(u.prototype,"getAllItems",function(a){var b=[],d=this.chart.colorAxis[0];d&&d.options&&(d.options.showInLegend&&(d.options.dataClasses?b=b.concat(d.getDataClassLegendSymbols()):b.push(d)),t(d.series,function(a){a.options.showInLegend=!1}));return b.concat(a.call(this))}),r(u.prototype,"colorizeItem",function(a,b,d){a.call(this,b,d);d&&b.legendColor&&b.legendSymbol.attr({fill:b.legendColor})}),r(u.prototype,"update",function(a){a.apply(this,
[].slice.call(arguments,1));this.chart.colorAxis[0]&&this.chart.colorAxis[0].update({},arguments[2])}))})(x);(function(a){var h=a.defined,m=a.each,f=a.noop;a.colorPointMixin={isValid:function(){return null!==this.value},setVisible:function(a){var e=this,f=a?"show":"hide";m(["graphic","dataLabel"],function(a){if(e[a])e[a][f]()})},setState:function(e){a.Point.prototype.setState.call(this,e);this.graphic&&this.graphic.attr({zIndex:"hover"===e?1:0})}};a.colorSeriesMixin={pointArrayMap:["value"],axisTypes:["xAxis",
"yAxis","colorAxis"],optionalAxis:"colorAxis",trackerGroups:["group","markerGroup","dataLabelsGroup"],getSymbol:f,parallelArrays:["x","y","value"],colorKey:"value",translateColors:function(){var a=this,t=this.options.nullColor,f=this.colorAxis,h=this.colorKey;m(this.data,function(e){var l=e[h];if(l=e.options.color||(e.isNull?t:f&&void 0!==l?f.toColor(l,e):e.color||a.color))e.color=l})},colorAttribs:function(a){var e={};h(a.color)&&(e[this.colorProp||"fill"]=a.color);return e}}})(x);(function(a){function h(a){a&&
(a.preventDefault&&a.preventDefault(),a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)}function m(a){this.init(a)}var f=a.addEvent,e=a.Chart,t=a.doc,p=a.each,v=a.extend,u=a.merge,l=a.pick,c=a.wrap;m.prototype.init=function(a){this.chart=a;a.mapNavButtons=[]};m.prototype.update=function(b){var c=this.chart,e=c.options.mapNavigation,n,g=function(a){this.handler.call(c,a);h(a)},d=c.mapNavButtons;b&&(e=c.options.mapNavigation=u(c.options.mapNavigation,b));for(;d.length;)d.pop().destroy();l(e.enableButtons,
e.enabled)&&!c.renderer.forExport&&a.objectEach(e.buttons,function(a,b){n=u(e.buttonOptions,a);a=c.renderer.button(n.text,0,0,g,void 0,void 0,void 0,0,"zoomIn"===b?"topbutton":"bottombutton").addClass("highcharts-map-navigation").attr({width:n.width,height:n.height,title:c.options.lang[b],padding:n.padding,zIndex:5}).add();a.handler=n.onclick;a.align(v(n,{width:a.width,height:2*a.height}),null,n.alignTo);f(a.element,"dblclick",h);d.push(a)});this.updateEvents(e)};m.prototype.updateEvents=function(a){var b=
this.chart;l(a.enableDoubleClickZoom,a.enabled)||a.enableDoubleClickZoomTo?this.unbindDblClick=this.unbindDblClick||f(b.container,"dblclick",function(a){b.pointer.onContainerDblClick(a)}):this.unbindDblClick&&(this.unbindDblClick=this.unbindDblClick());l(a.enableMouseWheelZoom,a.enabled)?this.unbindMouseWheel=this.unbindMouseWheel||f(b.container,void 0===t.onmousewheel?"DOMMouseScroll":"mousewheel",function(a){b.pointer.onContainerMouseWheel(a);h(a);return!1}):this.unbindMouseWheel&&(this.unbindMouseWheel=
this.unbindMouseWheel())};v(e.prototype,{fitToBox:function(a,c){p([["x","width"],["y","height"]],function(b){var e=b[0];b=b[1];a[e]+a[b]>c[e]+c[b]&&(a[b]>c[b]?(a[b]=c[b],a[e]=c[e]):a[e]=c[e]+c[b]-a[b]);a[b]>c[b]&&(a[b]=c[b]);a[e]<c[e]&&(a[e]=c[e])});return a},mapZoom:function(a,c,e,n,g){var d=this.xAxis[0],b=d.max-d.min,k=l(c,d.min+b/2),r=b*a,b=this.yAxis[0],f=b.max-b.min,t=l(e,b.min+f/2),f=f*a,k=this.fitToBox({x:k-r*(n?(n-d.pos)/d.len:.5),y:t-f*(g?(g-b.pos)/b.len:.5),width:r,height:f},{x:d.dataMin,
y:b.dataMin,width:d.dataMax-d.dataMin,height:b.dataMax-b.dataMin}),r=k.x<=d.dataMin&&k.width>=d.dataMax-d.dataMin&&k.y<=b.dataMin&&k.height>=b.dataMax-b.dataMin;n&&(d.fixTo=[n-d.pos,c]);g&&(b.fixTo=[g-b.pos,e]);void 0===a||r?(d.setExtremes(void 0,void 0,!1),b.setExtremes(void 0,void 0,!1)):(d.setExtremes(k.x,k.x+k.width,!1),b.setExtremes(k.y,k.y+k.height,!1));this.redraw()}});c(e.prototype,"render",function(a){this.mapNavigation=new m(this);this.mapNavigation.update();a.call(this)})})(x);(function(a){var h=
a.extend,m=a.pick,f=a.Pointer;a=a.wrap;h(f.prototype,{onContainerDblClick:function(a){var e=this.chart;a=this.normalize(a);e.options.mapNavigation.enableDoubleClickZoomTo?e.pointer.inClass(a.target,"highcharts-tracker")&&e.hoverPoint&&e.hoverPoint.zoomTo():e.isInsidePlot(a.chartX-e.plotLeft,a.chartY-e.plotTop)&&e.mapZoom(.5,e.xAxis[0].toValue(a.chartX),e.yAxis[0].toValue(a.chartY),a.chartX,a.chartY)},onContainerMouseWheel:function(a){var e=this.chart,f;a=this.normalize(a);f=a.detail||-(a.wheelDelta/
120);e.isInsidePlot(a.chartX-e.plotLeft,a.chartY-e.plotTop)&&e.mapZoom(Math.pow(e.options.mapNavigation.mouseWheelSensitivity,f),e.xAxis[0].toValue(a.chartX),e.yAxis[0].toValue(a.chartY),a.chartX,a.chartY)}});a(f.prototype,"zoomOption",function(a){var e=this.chart.options.mapNavigation;m(e.enableTouchZoom,e.enabled)&&(this.chart.options.chart.pinchType="xy");a.apply(this,[].slice.call(arguments,1))});a(f.prototype,"pinchTranslate",function(a,f,h,m,u,l,c){a.call(this,f,h,m,u,l,c);"map"===this.chart.options.chart.type&&
this.hasZoom&&(a=m.scaleX>m.scaleY,this.pinchTranslateDirection(!a,f,h,m,u,l,c,a?m.scaleX:m.scaleY))})})(x);(function(a){var h=a.colorPointMixin,m=a.each,f=a.extend,e=a.isNumber,t=a.map,p=a.merge,v=a.noop,u=a.pick,l=a.isArray,c=a.Point,b=a.Series,k=a.seriesType,r=a.seriesTypes,n=a.splat,g=void 0!==a.doc.documentElement.style.vectorEffect;k("map","scatter",{allAreas:!0,animation:!1,nullColor:"#f7f7f7",borderColor:"#cccccc",borderWidth:1,marker:null,stickyTracking:!1,joinBy:"hc-key",dataLabels:{formatter:function(){return this.point.value},
inside:!0,verticalAlign:"middle",crop:!1,overflow:!1,padding:0},turboThreshold:0,tooltip:{followPointer:!0,pointFormat:"{point.name}: {point.value}\x3cbr/\x3e"},states:{normal:{animation:!0},hover:{halo:null,brightness:.2},select:{color:"#cccccc"}}},p(a.colorSeriesMixin,{type:"map",getExtremesFromAll:!0,useMapGeometry:!0,forceDL:!0,searchPoint:v,directTouch:!0,preserveAspectRatio:!0,pointArrayMap:["value"],getBox:function(d){var b=Number.MAX_VALUE,c=-b,g=b,k=-b,l=b,n=b,f=this.xAxis,r=this.yAxis,h;
m(d||[],function(d){if(d.path){"string"===typeof d.path&&(d.path=a.splitPath(d.path));var q=d.path||[],w=q.length,f=!1,r=-b,m=b,z=-b,p=b,t=d.properties;if(!d._foundBox){for(;w--;)e(q[w])&&(f?(r=Math.max(r,q[w]),m=Math.min(m,q[w])):(z=Math.max(z,q[w]),p=Math.min(p,q[w])),f=!f);d._midX=m+(r-m)*u(d.middleX,t&&t["hc-middle-x"],.5);d._midY=p+(z-p)*u(d.middleY,t&&t["hc-middle-y"],.5);d._maxX=r;d._minX=m;d._maxY=z;d._minY=p;d.labelrank=u(d.labelrank,(r-m)*(z-p));d._foundBox=!0}c=Math.max(c,d._maxX);g=Math.min(g,
d._minX);k=Math.max(k,d._maxY);l=Math.min(l,d._minY);n=Math.min(d._maxX-d._minX,d._maxY-d._minY,n);h=!0}});h&&(this.minY=Math.min(l,u(this.minY,b)),this.maxY=Math.max(k,u(this.maxY,-b)),this.minX=Math.min(g,u(this.minX,b)),this.maxX=Math.max(c,u(this.maxX,-b)),f&&void 0===f.options.minRange&&(f.minRange=Math.min(5*n,(this.maxX-this.minX)/5,f.minRange||b)),r&&void 0===r.options.minRange&&(r.minRange=Math.min(5*n,(this.maxY-this.minY)/5,r.minRange||b)))},getExtremes:function(){b.prototype.getExtremes.call(this,
this.valueData);this.chart.hasRendered&&this.isDirtyData&&this.getBox(this.options.data);this.valueMin=this.dataMin;this.valueMax=this.dataMax;this.dataMin=this.minY;this.dataMax=this.maxY},translatePath:function(a){var d=!1,b=this.xAxis,c=this.yAxis,g=b.min,k=b.transA,b=b.minPixelPadding,l=c.min,n=c.transA,c=c.minPixelPadding,f,r=[];if(a)for(f=a.length;f--;)e(a[f])?(r[f]=d?(a[f]-g)*k+b:(a[f]-l)*n+c,d=!d):r[f]=a[f];return r},setData:function(d,c,g,k){var q=this.options,f=this.chart.options.chart,
r=f&&f.map,w=q.mapData,h=q.joinBy,v=null===h,u=q.keys||this.pointArrayMap,y=[],B={},A=this.chart.mapTransforms;!w&&r&&(w="string"===typeof r?a.maps[r]:r);v&&(h="_i");h=this.joinBy=n(h);h[1]||(h[1]=h[0]);d&&m(d,function(a,b){var c=0;if(e(a))d[b]={value:a};else if(l(a)){d[b]={};!q.keys&&a.length>u.length&&"string"===typeof a[0]&&(d[b]["hc-key"]=a[0],++c);for(var g=0;g<u.length;++g,++c)u[g]&&(d[b][u[g]]=a[c])}v&&(d[b]._i=b)});this.getBox(d);(this.chart.mapTransforms=A=f&&f.mapTransforms||w&&w["hc-transform"]||
A)&&a.objectEach(A,function(a){a.rotation&&(a.cosAngle=Math.cos(a.rotation),a.sinAngle=Math.sin(a.rotation))});if(w){"FeatureCollection"===w.type&&(this.mapTitle=w.title,w=a.geojson(w,this.type,this));this.mapData=w;this.mapMap={};for(A=0;A<w.length;A++)f=w[A],r=f.properties,f._i=A,h[0]&&r&&r[h[0]]&&(f[h[0]]=r[h[0]]),B[f[h[0]]]=f;this.mapMap=B;d&&h[1]&&m(d,function(a){B[a[h[1]]]&&y.push(B[a[h[1]]])});q.allAreas?(this.getBox(w),d=d||[],h[1]&&m(d,function(a){y.push(a[h[1]])}),y="|"+t(y,function(a){return a&&
a[h[0]]}).join("|")+"|",m(w,function(a){h[0]&&-1!==y.indexOf("|"+a[h[0]]+"|")||(d.push(p(a,{value:null})),k=!1)})):this.getBox(y)}b.prototype.setData.call(this,d,c,g,k)},drawGraph:v,drawDataLabels:v,doFullTranslate:function(){return this.isDirtyData||this.chart.isResizing||this.chart.renderer.isVML||!this.baseTrans},translate:function(){var a=this,b=a.xAxis,c=a.yAxis,g=a.doFullTranslate();a.generatePoints();m(a.data,function(d){d.plotX=b.toPixels(d._midX,!0);d.plotY=c.toPixels(d._midY,!0);g&&(d.shapeType=
"path",d.shapeArgs={d:a.translatePath(d.path)})});a.translateColors()},pointAttribs:function(a,b){a=this.colorAttribs(a);g?a["vector-effect"]="non-scaling-stroke":a["stroke-width"]="inherit";return a},drawPoints:function(){var a=this,b=a.xAxis,c=a.yAxis,k=a.group,e=a.chart,l=e.renderer,f,n,h,p,t=this.baseTrans,y,u,v,x,G;a.transformGroup||(a.transformGroup=l.g().attr({scaleX:1,scaleY:1}).add(k),a.transformGroup.survive=!0);a.doFullTranslate()?(a.group=a.transformGroup,r.column.prototype.drawPoints.apply(a),
a.group=k,m(a.points,function(b){b.graphic&&(b.name&&b.graphic.addClass("highcharts-name-"+b.name.replace(/ /g,"-").toLowerCase()),b.properties&&b.properties["hc-key"]&&b.graphic.addClass("highcharts-key-"+b.properties["hc-key"].toLowerCase()),b.graphic.css(a.pointAttribs(b,b.selected&&"select")))}),this.baseTrans={originX:b.min-b.minPixelPadding/b.transA,originY:c.min-c.minPixelPadding/c.transA+(c.reversed?0:c.len/c.transA),transAX:b.transA,transAY:c.transA},this.transformGroup.animate({translateX:0,
translateY:0,scaleX:1,scaleY:1})):(f=b.transA/t.transAX,n=c.transA/t.transAY,h=b.toPixels(t.originX,!0),p=c.toPixels(t.originY,!0),.99<f&&1.01>f&&.99<n&&1.01>n&&(n=f=1,h=Math.round(h),p=Math.round(p)),y=this.transformGroup,e.renderer.globalAnimation?(u=y.attr("translateX"),v=y.attr("translateY"),x=y.attr("scaleX"),G=y.attr("scaleY"),y.attr({animator:0}).animate({animator:1},{step:function(a,b){y.attr({translateX:u+(h-u)*b.pos,translateY:v+(p-v)*b.pos,scaleX:x+(f-x)*b.pos,scaleY:G+(n-G)*b.pos})}})):
y.attr({translateX:h,translateY:p,scaleX:f,scaleY:n}));g||a.group.element.setAttribute("stroke-width",a.options[a.pointAttrToOptions&&a.pointAttrToOptions["stroke-width"]||"borderWidth"]/(f||1));this.drawMapDataLabels()},drawMapDataLabels:function(){b.prototype.drawDataLabels.call(this);this.dataLabelsGroup&&this.dataLabelsGroup.clip(this.chart.clipRect)},render:function(){var a=this,c=b.prototype.render;a.chart.renderer.isVML&&3E3<a.data.length?setTimeout(function(){c.call(a)}):c.call(a)},animate:function(a){var b=
this.options.animation,d=this.group,c=this.xAxis,g=this.yAxis,k=c.pos,e=g.pos;this.chart.renderer.isSVG&&(!0===b&&(b={duration:1E3}),a?d.attr({translateX:k+c.len/2,translateY:e+g.len/2,scaleX:.001,scaleY:.001}):(d.animate({translateX:k,translateY:e,scaleX:1,scaleY:1},b),this.animate=null))},animateDrilldown:function(a){var b=this.chart.plotBox,d=this.chart.drilldownLevels[this.chart.drilldownLevels.length-1],c=d.bBox,g=this.chart.options.drilldown.animation;a||(a=Math.min(c.width/b.width,c.height/
b.height),d.shapeArgs={scaleX:a,scaleY:a,translateX:c.x,translateY:c.y},m(this.points,function(a){a.graphic&&a.graphic.attr(d.shapeArgs).animate({scaleX:1,scaleY:1,translateX:0,translateY:0},g)}),this.animate=null)},drawLegendSymbol:a.LegendSymbolMixin.drawRectangle,animateDrillupFrom:function(a){r.column.prototype.animateDrillupFrom.call(this,a)},animateDrillupTo:function(a){r.column.prototype.animateDrillupTo.call(this,a)}}),f({applyOptions:function(a,b){a=c.prototype.applyOptions.call(this,a,b);
b=this.series;var d=b.joinBy;b.mapData&&((d=void 0!==a[d[1]]&&b.mapMap[a[d[1]]])?(b.xyFromShape&&(a.x=d._midX,a.y=d._midY),f(a,d)):a.value=a.value||null);return a},onMouseOver:function(a){clearTimeout(this.colorInterval);if(null!==this.value||this.series.options.nullInteraction)c.prototype.onMouseOver.call(this,a);else this.series.onMouseOut(a)},zoomTo:function(){var a=this.series;a.xAxis.setExtremes(this._minX,this._maxX,!1);a.yAxis.setExtremes(this._minY,this._maxY,!1);a.chart.redraw()}},h))})(x);
(function(a){var h=a.seriesType;h("mapline","map",{},{type:"mapline",colorProp:"stroke",drawLegendSymbol:a.seriesTypes.line.prototype.drawLegendSymbol})})(x);(function(a){var h=a.merge,m=a.Point;a=a.seriesType;a("mappoint","scatter",{dataLabels:{enabled:!0,formatter:function(){return this.point.name},crop:!1,defer:!1,overflow:!1,style:{color:"#000000"}}},{type:"mappoint",forceDL:!0},{applyOptions:function(a,e){a=void 0!==a.lat&&void 0!==a.lon?h(a,this.series.chart.fromLatLonToPoint(a)):a;return m.prototype.applyOptions.call(this,
a,e)}})})(x);(function(a){var h=a.arrayMax,m=a.arrayMin,f=a.Axis,e=a.each,t=a.isNumber,p=a.noop,v=a.pick,u=a.pInt,l=a.Point,c=a.seriesType,b=a.seriesTypes;c("bubble","scatter",{dataLabels:{formatter:function(){return this.point.z},inside:!0,verticalAlign:"middle"},marker:{radius:null,states:{hover:{radiusPlus:0}},symbol:"circle"},minSize:8,maxSize:"20%",softThreshold:!1,states:{hover:{halo:{size:5}}},tooltip:{pointFormat:"({point.x}, {point.y}), Size: {point.z}"},turboThreshold:0,zThreshold:0,zoneAxis:"z"},
{pointArrayMap:["y","z"],parallelArrays:["x","y","z"],trackerGroups:["group","dataLabelsGroup"],specialGroup:"group",bubblePadding:!0,zoneAxis:"z",directTouch:!0,getRadii:function(a,b,c,g){var d,e,k,l=this.zData,f=[],n=this.options,r="width"!==n.sizeBy,h=n.zThreshold,m=b-a;e=0;for(d=l.length;e<d;e++)k=l[e],n.sizeByAbsoluteValue&&null!==k&&(k=Math.abs(k-h),b=Math.max(b-h,Math.abs(a-h)),a=0),null===k?k=null:k<a?k=c/2-1:(k=0<m?(k-a)/m:.5,r&&0<=k&&(k=Math.sqrt(k)),k=Math.ceil(c+k*(g-c))/2),f.push(k);
this.radii=f},animate:function(a){var b=this.options.animation;a||(e(this.points,function(a){var c=a.graphic,d;c&&c.width&&(d={x:c.x,y:c.y,width:c.width,height:c.height},c.attr({x:a.plotX,y:a.plotY,width:1,height:1}),c.animate(d,b))}),this.animate=null)},translate:function(){var c,e=this.data,l,g,d=this.radii;b.scatter.prototype.translate.call(this);for(c=e.length;c--;)l=e[c],g=d?d[c]:0,t(g)&&g>=this.minPxSize/2?(l.marker=a.extend(l.marker,{radius:g,width:2*g,height:2*g}),l.dlBox={x:l.plotX-g,y:l.plotY-
g,width:2*g,height:2*g}):l.shapeArgs=l.plotY=l.dlBox=void 0},alignDataLabel:b.column.prototype.alignDataLabel,buildKDTree:p,applyZones:p},{haloPath:function(a){return l.prototype.haloPath.call(this,0===a?0:(this.marker?this.marker.radius||0:0)+a)},ttBelow:!1});f.prototype.beforePadding=function(){var a=this,b=this.len,c=this.chart,g=0,d=b,l=this.isXAxis,f=l?"xData":"yData",p=this.min,x={},H=Math.min(c.plotWidth,c.plotHeight),D=Number.MAX_VALUE,E=-Number.MAX_VALUE,z=this.max-p,C=b/z,F=[];e(this.series,
function(b){var d=b.options;!b.bubblePadding||!b.visible&&c.options.chart.ignoreHiddenSeries||(a.allowZoomOutside=!0,F.push(b),l&&(e(["minSize","maxSize"],function(a){var b=d[a],c=/%$/.test(b),b=u(b);x[a]=c?H*b/100:b}),b.minPxSize=x.minSize,b.maxPxSize=Math.max(x.maxSize,x.minSize),b=b.zData,b.length&&(D=v(d.zMin,Math.min(D,Math.max(m(b),!1===d.displayNegative?d.zThreshold:-Number.MAX_VALUE))),E=v(d.zMax,Math.max(E,h(b))))))});e(F,function(b){var c=b[f],e=c.length,k;l&&b.getRadii(D,E,b.minPxSize,
b.maxPxSize);if(0<z)for(;e--;)t(c[e])&&a.dataMin<=c[e]&&c[e]<=a.dataMax&&(k=b.radii[e],g=Math.min((c[e]-p)*C-k,g),d=Math.max((c[e]-p)*C+k,d))});F.length&&0<z&&!this.isLog&&(d-=b,C*=(b+g-d)/b,e([["min","userMin",g],["max","userMax",d]],function(b){void 0===v(a.options[b[0]],a[b[1]])&&(a[b[0]]+=b[2]/C)}))}})(x);(function(a){var h=a.merge,m=a.Point,f=a.seriesType,e=a.seriesTypes;e.bubble&&f("mapbubble","bubble",{animationLimit:500,tooltip:{pointFormat:"{point.name}: {point.z}"}},{xyFromShape:!0,type:"mapbubble",
pointArrayMap:["z"],getMapData:e.map.prototype.getMapData,getBox:e.map.prototype.getBox,setData:e.map.prototype.setData},{applyOptions:function(a,f){return a&&void 0!==a.lat&&void 0!==a.lon?m.prototype.applyOptions.call(this,h(a,this.series.chart.fromLatLonToPoint(a)),f):e.map.prototype.pointClass.prototype.applyOptions.call(this,a,f)},isValid:function(){return"number"===typeof this.z},ttBelow:!1})})(x);(function(a){var h=a.colorPointMixin,m=a.each,f=a.merge,e=a.noop,t=a.pick,p=a.Series,v=a.seriesType,
u=a.seriesTypes;v("heatmap","scatter",{animation:!1,borderWidth:0,dataLabels:{formatter:function(){return this.point.value},inside:!0,verticalAlign:"middle",crop:!1,overflow:!1,padding:0},marker:null,pointRange:null,tooltip:{pointFormat:"{point.x}, {point.y}: {point.value}\x3cbr/\x3e"},states:{normal:{animation:!0},hover:{halo:!1,brightness:.2}}},f(a.colorSeriesMixin,{pointArrayMap:["y","value"],hasPointSpecificOptions:!0,getExtremesFromAll:!0,directTouch:!0,init:function(){var a;u.scatter.prototype.init.apply(this,
arguments);a=this.options;a.pointRange=t(a.pointRange,a.colsize||1);this.yAxis.axisPointRange=a.rowsize||1},translate:function(){var a=this.options,c=this.xAxis,b=this.yAxis,e=a.pointPadding||0,f=function(a,b,c){return Math.min(Math.max(b,a),c)};this.generatePoints();m(this.points,function(k){var g=(a.colsize||1)/2,d=(a.rowsize||1)/2,l=f(Math.round(c.len-c.translate(k.x-g,0,1,0,1)),-c.len,2*c.len),g=f(Math.round(c.len-c.translate(k.x+g,0,1,0,1)),-c.len,2*c.len),h=f(Math.round(b.translate(k.y-d,0,
1,0,1)),-b.len,2*b.len),d=f(Math.round(b.translate(k.y+d,0,1,0,1)),-b.len,2*b.len),n=t(k.pointPadding,e);k.plotX=k.clientX=(l+g)/2;k.plotY=(h+d)/2;k.shapeType="rect";k.shapeArgs={x:Math.min(l,g)+n,y:Math.min(h,d)+n,width:Math.abs(g-l)-2*n,height:Math.abs(d-h)-2*n}});this.translateColors()},drawPoints:function(){u.column.prototype.drawPoints.call(this);m(this.points,function(a){a.graphic.css(this.colorAttribs(a))},this)},animate:e,getBox:e,drawLegendSymbol:a.LegendSymbolMixin.drawRectangle,alignDataLabel:u.column.prototype.alignDataLabel,
getExtremes:function(){p.prototype.getExtremes.call(this,this.valueData);this.valueMin=this.dataMin;this.valueMax=this.dataMax;p.prototype.getExtremes.call(this)}}),a.extend({haloPath:function(a){if(!a)return[];var c=this.shapeArgs;return["M",c.x-a,c.y-a,"L",c.x-a,c.y+c.height+a,c.x+c.width+a,c.y+c.height+a,c.x+c.width+a,c.y-a,"Z"]}},h))})(x);(function(a){function h(a,c){var b,e,f,l=!1,g=a.x,d=a.y;a=0;for(b=c.length-1;a<c.length;b=a++)e=c[a][1]>d,f=c[b][1]>d,e!==f&&g<(c[b][0]-c[a][0])*(d-c[a][1])/
(c[b][1]-c[a][1])+c[a][0]&&(l=!l);return l}var m=a.Chart,f=a.each,e=a.extend,t=a.format,p=a.merge,v=a.win,u=a.wrap;m.prototype.transformFromLatLon=function(e,c){if(void 0===v.proj4)return a.error(21),{x:0,y:null};e=v.proj4(c.crs,[e.lon,e.lat]);var b=c.cosAngle||c.rotation&&Math.cos(c.rotation),k=c.sinAngle||c.rotation&&Math.sin(c.rotation);e=c.rotation?[e[0]*b+e[1]*k,-e[0]*k+e[1]*b]:e;return{x:((e[0]-(c.xoffset||0))*(c.scale||1)+(c.xpan||0))*(c.jsonres||1)+(c.jsonmarginX||0),y:(((c.yoffset||0)-e[1])*
(c.scale||1)+(c.ypan||0))*(c.jsonres||1)-(c.jsonmarginY||0)}};m.prototype.transformToLatLon=function(e,c){if(void 0===v.proj4)a.error(21);else{e={x:((e.x-(c.jsonmarginX||0))/(c.jsonres||1)-(c.xpan||0))/(c.scale||1)+(c.xoffset||0),y:((-e.y-(c.jsonmarginY||0))/(c.jsonres||1)+(c.ypan||0))/(c.scale||1)+(c.yoffset||0)};var b=c.cosAngle||c.rotation&&Math.cos(c.rotation),k=c.sinAngle||c.rotation&&Math.sin(c.rotation);c=v.proj4(c.crs,"WGS84",c.rotation?{x:e.x*b+e.y*-k,y:e.x*k+e.y*b}:e);return{lat:c.y,lon:c.x}}};
m.prototype.fromPointToLatLon=function(e){var c=this.mapTransforms,b;if(c){for(b in c)if(c.hasOwnProperty(b)&&c[b].hitZone&&h({x:e.x,y:-e.y},c[b].hitZone.coordinates[0]))return this.transformToLatLon(e,c[b]);return this.transformToLatLon(e,c["default"])}a.error(22)};m.prototype.fromLatLonToPoint=function(e){var c=this.mapTransforms,b,k;if(!c)return a.error(22),{x:0,y:null};for(b in c)if(c.hasOwnProperty(b)&&c[b].hitZone&&(k=this.transformFromLatLon(e,c[b]),h({x:k.x,y:-k.y},c[b].hitZone.coordinates[0])))return k;
return this.transformFromLatLon(e,c["default"])};a.geojson=function(a,c,b){var k=[],h=[],n=function(a){var b,c=a.length;h.push("M");for(b=0;b<c;b++)1===b&&h.push("L"),h.push(a[b][0],-a[b][1])};c=c||"map";f(a.features,function(a){var b=a.geometry,g=b.type,b=b.coordinates;a=a.properties;var l;h=[];"map"===c||"mapbubble"===c?("Polygon"===g?(f(b,n),h.push("Z")):"MultiPolygon"===g&&(f(b,function(a){f(a,n)}),h.push("Z")),h.length&&(l={path:h})):"mapline"===c?("LineString"===g?n(b):"MultiLineString"===g&&
f(b,n),h.length&&(l={path:h})):"mappoint"===c&&"Point"===g&&(l={x:b[0],y:-b[1]});l&&k.push(e(l,{name:a.name||a.NAME,properties:a}))});b&&a.copyrightShort&&(b.chart.mapCredits=t(b.chart.options.credits.mapText,{geojson:a}),b.chart.mapCreditsFull=t(b.chart.options.credits.mapTextFull,{geojson:a}));return k};u(m.prototype,"addCredits",function(a,c){c=p(!0,this.options.credits,c);this.mapCredits&&(c.href=null);a.call(this,c);this.credits&&this.mapCreditsFull&&this.credits.attr({title:this.mapCreditsFull})})})(x);
(function(a){function h(a,c,e,f,g,d,h,l){return["M",a+g,c,"L",a+e-d,c,"C",a+e-d/2,c,a+e,c+d/2,a+e,c+d,"L",a+e,c+f-h,"C",a+e,c+f-h/2,a+e-h/2,c+f,a+e-h,c+f,"L",a+l,c+f,"C",a+l/2,c+f,a,c+f-l/2,a,c+f-l,"L",a,c+g,"C",a,c+g/2,a+g/2,c,a+g,c,"Z"]}var m=a.Chart,f=a.defaultOptions,e=a.each,t=a.extend,p=a.merge,v=a.pick,u=a.Renderer,l=a.SVGRenderer,c=a.VMLRenderer;t(f.lang,{zoomIn:"Zoom in",zoomOut:"Zoom out"});f.mapNavigation={buttonOptions:{alignTo:"plotBox",align:"left",verticalAlign:"top",x:0,width:18,height:18,
padding:5},buttons:{zoomIn:{onclick:function(){this.mapZoom(.5)},text:"+",y:0},zoomOut:{onclick:function(){this.mapZoom(2)},text:"-",y:28}},mouseWheelSensitivity:1.1};a.splitPath=function(a){var b;a=a.replace(/([A-Za-z])/g," $1 ");a=a.replace(/^\s*/,"").replace(/\s*$/,"");a=a.split(/[ ,]+/);for(b=0;b<a.length;b++)/[a-zA-Z]/.test(a[b])||(a[b]=parseFloat(a[b]));return a};a.maps={};l.prototype.symbols.topbutton=function(a,c,e,f,g){return h(a-1,c-1,e,f,g.r,g.r,0,0)};l.prototype.symbols.bottombutton=function(a,
c,e,f,g){return h(a-1,c-1,e,f,0,0,g.r,g.r)};u===c&&e(["topbutton","bottombutton"],function(a){c.prototype.symbols[a]=l.prototype.symbols[a]});a.Map=a.mapChart=function(b,c,e){var f="string"===typeof b||b.nodeName,g=arguments[f?1:0],d={endOnTick:!1,visible:!1,minPadding:0,maxPadding:0,startOnTick:!1},h,k=a.getOptions().credits;h=g.series;g.series=null;g=p({chart:{panning:"xy",type:"map"},credits:{mapText:v(k.mapText,' \u00a9 \x3ca href\x3d"{geojson.copyrightUrl}"\x3e{geojson.copyrightShort}\x3c/a\x3e'),
mapTextFull:v(k.mapTextFull,"{geojson.copyright}")},tooltip:{followTouchMove:!1},xAxis:d,yAxis:p(d,{reversed:!0})},g,{chart:{inverted:!1,alignTicks:!1}});g.series=h;return f?new m(b,g,e):new m(g,c)}})(x)});
