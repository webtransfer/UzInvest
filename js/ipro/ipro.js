/*
 * jQuery Form Plugin; v20130616
 * http://jquery.malsup.com/form/
 * Copyright (c) 2013 M. Alsup; Dual licensed: MIT/GPL
 * https://github.com/malsup/form#copyright-and-license
 */
;(function(e){"use strict";function t(t){var r=t.data;t.isDefaultPrevented()||(t.preventDefault(),e(this).ajaxSubmit(r))}function r(t){var r=t.target,a=e(r);if(!a.is("[type=submit],[type=image]")){var n=a.closest("[type=submit]");if(0===n.length)return;r=n[0]}var i=this;if(i.clk=r,"image"==r.type)if(void 0!==t.offsetX)i.clk_x=t.offsetX,i.clk_y=t.offsetY;else if("function"==typeof e.fn.offset){var o=a.offset();i.clk_x=t.pageX-o.left,i.clk_y=t.pageY-o.top}else i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop;setTimeout(function(){i.clk=i.clk_x=i.clk_y=null},100)}function a(){if(e.fn.ajaxSubmit.debug){var t="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)}}var n={};n.fileapi=void 0!==e("<input type='file'/>").get(0).files,n.formdata=void 0!==window.FormData;var i=!!e.fn.prop;e.fn.attr2=function(){if(!i)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},e.fn.ajaxSubmit=function(t){function r(r){var a,n,i=e.param(r,t.traditional).split("&"),o=i.length,s=[];for(a=0;o>a;a++)i[a]=i[a].replace(/\+/g," "),n=i[a].split("="),s.push([decodeURIComponent(n[0]),decodeURIComponent(n[1])]);return s}function o(a){for(var n=new FormData,i=0;a.length>i;i++)n.append(a[i].name,a[i].value);if(t.extraData){var o=r(t.extraData);for(i=0;o.length>i;i++)o[i]&&n.append(o[i][0],o[i][1])}t.data=null;var s=e.extend(!0,{},e.ajaxSettings,t,{contentType:!1,processData:!1,cache:!1,type:u||"POST"});t.uploadProgress&&(s.xhr=function(){var r=e.ajaxSettings.xhr();return r.upload&&r.upload.addEventListener("progress",function(e){var r=0,a=e.loaded||e.position,n=e.total;e.lengthComputable&&(r=Math.ceil(100*(a/n))),t.uploadProgress(e,a,n,r)},!1),r}),s.data=null;var l=s.beforeSend;return s.beforeSend=function(e,t){t.data=n,l&&l.call(this,e,t)},e.ajax(s)}function s(r){function n(e){var t=null;try{e.contentWindow&&(t=e.contentWindow.document)}catch(r){a("cannot get iframe.contentWindow document: "+r)}if(t)return t;try{t=e.contentDocument?e.contentDocument:e.document}catch(r){a("cannot get iframe.contentDocument: "+r),t=e.document}return t}function o(){function t(){try{var e=n(g).readyState;a("state = "+e),e&&"uninitialized"==e.toLowerCase()&&setTimeout(t,50)}catch(r){a("Server abort: ",r," (",r.name,")"),s(D),j&&clearTimeout(j),j=void 0}}var r=f.attr2("target"),i=f.attr2("action");w.setAttribute("target",d),u||w.setAttribute("method","POST"),i!=m.url&&w.setAttribute("action",m.url),m.skipEncodingOverride||u&&!/post/i.test(u)||f.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),m.timeout&&(j=setTimeout(function(){T=!0,s(k)},m.timeout));var o=[];try{if(m.extraData)for(var l in m.extraData)m.extraData.hasOwnProperty(l)&&(e.isPlainObject(m.extraData[l])&&m.extraData[l].hasOwnProperty("name")&&m.extraData[l].hasOwnProperty("value")?o.push(e('<input type="hidden" name="'+m.extraData[l].name+'">').val(m.extraData[l].value).appendTo(w)[0]):o.push(e('<input type="hidden" name="'+l+'">').val(m.extraData[l]).appendTo(w)[0]));m.iframeTarget||(v.appendTo("body"),g.attachEvent?g.attachEvent("onload",s):g.addEventListener("load",s,!1)),setTimeout(t,15);try{w.submit()}catch(c){var p=document.createElement("form").submit;p.apply(w)}}finally{w.setAttribute("action",i),r?w.setAttribute("target",r):f.removeAttr("target"),e(o).remove()}}function s(t){if(!x.aborted&&!F){if(M=n(g),M||(a("cannot access response document"),t=D),t===k&&x)return x.abort("timeout"),S.reject(x,"timeout"),void 0;if(t==D&&x)return x.abort("server abort"),S.reject(x,"error","server abort"),void 0;if(M&&M.location.href!=m.iframeSrc||T){g.detachEvent?g.detachEvent("onload",s):g.removeEventListener("load",s,!1);var r,i="success";try{if(T)throw"timeout";var o="xml"==m.dataType||M.XMLDocument||e.isXMLDoc(M);if(a("isXml="+o),!o&&window.opera&&(null===M.body||!M.body.innerHTML)&&--O)return a("requeing onLoad callback, DOM not available"),setTimeout(s,250),void 0;var u=M.body?M.body:M.documentElement;x.responseText=u?u.innerHTML:null,x.responseXML=M.XMLDocument?M.XMLDocument:M,o&&(m.dataType="xml"),x.getResponseHeader=function(e){var t={"content-type":m.dataType};return t[e]},u&&(x.status=Number(u.getAttribute("status"))||x.status,x.statusText=u.getAttribute("statusText")||x.statusText);var l=(m.dataType||"").toLowerCase(),c=/(json|script|text)/.test(l);if(c||m.textarea){var f=M.getElementsByTagName("textarea")[0];if(f)x.responseText=f.value,x.status=Number(f.getAttribute("status"))||x.status,x.statusText=f.getAttribute("statusText")||x.statusText;else if(c){var d=M.getElementsByTagName("pre")[0],h=M.getElementsByTagName("body")[0];d?x.responseText=d.textContent?d.textContent:d.innerText:h&&(x.responseText=h.textContent?h.textContent:h.innerText)}}else"xml"==l&&!x.responseXML&&x.responseText&&(x.responseXML=X(x.responseText));try{L=_(x,l,m)}catch(b){i="parsererror",x.error=r=b||i}}catch(b){a("error caught: ",b),i="error",x.error=r=b||i}x.aborted&&(a("upload aborted"),i=null),x.status&&(i=x.status>=200&&300>x.status||304===x.status?"success":"error"),"success"===i?(m.success&&m.success.call(m.context,L,"success",x),S.resolve(x.responseText,"success",x),p&&e.event.trigger("ajaxSuccess",[x,m])):i&&(void 0===r&&(r=x.statusText),m.error&&m.error.call(m.context,x,i,r),S.reject(x,"error",r),p&&e.event.trigger("ajaxError",[x,m,r])),p&&e.event.trigger("ajaxComplete",[x,m]),p&&!--e.active&&e.event.trigger("ajaxStop"),m.complete&&m.complete.call(m.context,x,i),F=!0,m.timeout&&clearTimeout(j),setTimeout(function(){m.iframeTarget||v.remove(),x.responseXML=null},100)}}}var l,c,m,p,d,v,g,x,b,y,T,j,w=f[0],S=e.Deferred();if(r)for(c=0;h.length>c;c++)l=e(h[c]),i?l.prop("disabled",!1):l.removeAttr("disabled");if(m=e.extend(!0,{},e.ajaxSettings,t),m.context=m.context||m,d="jqFormIO"+(new Date).getTime(),m.iframeTarget?(v=e(m.iframeTarget),y=v.attr2("name"),y?d=y:v.attr2("name",d)):(v=e('<iframe name="'+d+'" src="'+m.iframeSrc+'" />'),v.css({position:"absolute",top:"-1000px",left:"-1000px"})),g=v[0],x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var r="timeout"===t?"timeout":"aborted";a("aborting upload... "+r),this.aborted=1;try{g.contentWindow.document.execCommand&&g.contentWindow.document.execCommand("Stop")}catch(n){}v.attr("src",m.iframeSrc),x.error=r,m.error&&m.error.call(m.context,x,r,t),p&&e.event.trigger("ajaxError",[x,m,r]),m.complete&&m.complete.call(m.context,x,r)}},p=m.global,p&&0===e.active++&&e.event.trigger("ajaxStart"),p&&e.event.trigger("ajaxSend",[x,m]),m.beforeSend&&m.beforeSend.call(m.context,x,m)===!1)return m.global&&e.active--,S.reject(),S;if(x.aborted)return S.reject(),S;b=w.clk,b&&(y=b.name,y&&!b.disabled&&(m.extraData=m.extraData||{},m.extraData[y]=b.value,"image"==b.type&&(m.extraData[y+".x"]=w.clk_x,m.extraData[y+".y"]=w.clk_y)));var k=1,D=2,A=e("meta[name=csrf-token]").attr("content"),E=e("meta[name=csrf-param]").attr("content");E&&A&&(m.extraData=m.extraData||{},m.extraData[E]=A),m.forceSync?o():setTimeout(o,10);var L,M,F,O=50,X=e.parseXML||function(e,t){return window.ActiveXObject?(t=new ActiveXObject("Microsoft.XMLDOM"),t.async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!=t.documentElement.nodeName?t:null},C=e.parseJSON||function(e){return window.eval("("+e+")")},_=function(t,r,a){var n=t.getResponseHeader("content-type")||"",i="xml"===r||!r&&n.indexOf("xml")>=0,o=i?t.responseXML:t.responseText;return i&&"parsererror"===o.documentElement.nodeName&&e.error&&e.error("parsererror"),a&&a.dataFilter&&(o=a.dataFilter(o,r)),"string"==typeof o&&("json"===r||!r&&n.indexOf("json")>=0?o=C(o):("script"===r||!r&&n.indexOf("javascript")>=0)&&e.globalEval(o)),o};return S}if(!this.length)return a("ajaxSubmit: skipping submit process - no element selected"),this;var u,l,c,f=this;"function"==typeof t&&(t={success:t}),u=t.type||this.attr2("method"),l=t.url||this.attr2("action"),c="string"==typeof l?e.trim(l):"",c=c||window.location.href||"",c&&(c=(c.match(/^([^#]+)/)||[])[1]),t=e.extend(!0,{url:c,success:e.ajaxSettings.success,type:u||"GET",iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var m={};if(this.trigger("form-pre-serialize",[this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(t.beforeSerialize&&t.beforeSerialize(this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var p=t.traditional;void 0===p&&(p=e.ajaxSettings.traditional);var d,h=[],v=this.formToArray(t.semantic,h);if(t.data&&(t.extraData=t.data,d=e.param(t.data,p)),t.beforeSubmit&&t.beforeSubmit(v,this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[v,this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var g=e.param(v,p);d&&(g=g?g+"&"+d:d),"GET"==t.type.toUpperCase()?(t.url+=(t.url.indexOf("?")>=0?"&":"?")+g,t.data=null):t.data=g;var x=[];if(t.resetForm&&x.push(function(){f.resetForm()}),t.clearForm&&x.push(function(){f.clearForm(t.includeHidden)}),!t.dataType&&t.target){var b=t.success||function(){};x.push(function(r){var a=t.replaceTarget?"replaceWith":"html";e(t.target)[a](r).each(b,arguments)})}else t.success&&x.push(t.success);if(t.success=function(e,r,a){for(var n=t.context||this,i=0,o=x.length;o>i;i++)x[i].apply(n,[e,r,a||f,f])},t.error){var y=t.error;t.error=function(e,r,a){var n=t.context||this;y.apply(n,[e,r,a,f])}}if(t.complete){var T=t.complete;t.complete=function(e,r){var a=t.context||this;T.apply(a,[e,r,f])}}var j=e('input[type=file]:enabled[value!=""]',this),w=j.length>0,S="multipart/form-data",k=f.attr("enctype")==S||f.attr("encoding")==S,D=n.fileapi&&n.formdata;a("fileAPI :"+D);var A,E=(w||k)&&!D;t.iframe!==!1&&(t.iframe||E)?t.closeKeepAlive?e.get(t.closeKeepAlive,function(){A=s(v)}):A=s(v):A=(w||k)&&D?o(v):e.ajax(t),f.removeData("jqxhr").data("jqxhr",A);for(var L=0;h.length>L;L++)h[L]=null;return this.trigger("form-submit-notify",[this,t]),this},e.fn.ajaxForm=function(n){if(n=n||{},n.delegation=n.delegation&&e.isFunction(e.fn.on),!n.delegation&&0===this.length){var i={s:this.selector,c:this.context};return!e.isReady&&i.s?(a("DOM not ready, queuing ajaxForm"),e(function(){e(i.s,i.c).ajaxForm(n)}),this):(a("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)")),this)}return n.delegation?(e(document).off("submit.form-plugin",this.selector,t).off("click.form-plugin",this.selector,r).on("submit.form-plugin",this.selector,n,t).on("click.form-plugin",this.selector,n,r),this):this.ajaxFormUnbind().bind("submit.form-plugin",n,t).bind("click.form-plugin",n,r)},e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")},e.fn.formToArray=function(t,r){var a=[];if(0===this.length)return a;var i=this[0],o=t?i.getElementsByTagName("*"):i.elements;if(!o)return a;var s,u,l,c,f,m,p;for(s=0,m=o.length;m>s;s++)if(f=o[s],l=f.name,l&&!f.disabled)if(t&&i.clk&&"image"==f.type)i.clk==f&&(a.push({name:l,value:e(f).val(),type:f.type}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}));else if(c=e.fieldValue(f,!0),c&&c.constructor==Array)for(r&&r.push(f),u=0,p=c.length;p>u;u++)a.push({name:l,value:c[u]});else if(n.fileapi&&"file"==f.type){r&&r.push(f);var d=f.files;if(d.length)for(u=0;d.length>u;u++)a.push({name:l,value:d[u],type:f.type});else a.push({name:l,value:"",type:f.type})}else null!==c&&c!==void 0&&(r&&r.push(f),a.push({name:l,value:c,type:f.type,required:f.required}));if(!t&&i.clk){var h=e(i.clk),v=h[0];l=v.name,l&&!v.disabled&&"image"==v.type&&(a.push({name:l,value:h.val()}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}))}return a},e.fn.formSerialize=function(t){return e.param(this.formToArray(t))},e.fn.fieldSerialize=function(t){var r=[];return this.each(function(){var a=this.name;if(a){var n=e.fieldValue(this,t);if(n&&n.constructor==Array)for(var i=0,o=n.length;o>i;i++)r.push({name:a,value:n[i]});else null!==n&&n!==void 0&&r.push({name:this.name,value:n})}}),e.param(r)},e.fn.fieldValue=function(t){for(var r=[],a=0,n=this.length;n>a;a++){var i=this[a],o=e.fieldValue(i,t);null===o||void 0===o||o.constructor==Array&&!o.length||(o.constructor==Array?e.merge(r,o):r.push(o))}return r},e.fieldValue=function(t,r){var a=t.name,n=t.type,i=t.tagName.toLowerCase();if(void 0===r&&(r=!0),r&&(!a||t.disabled||"reset"==n||"button"==n||("checkbox"==n||"radio"==n)&&!t.checked||("submit"==n||"image"==n)&&t.form&&t.form.clk!=t||"select"==i&&-1==t.selectedIndex))return null;if("select"==i){var o=t.selectedIndex;if(0>o)return null;for(var s=[],u=t.options,l="select-one"==n,c=l?o+1:u.length,f=l?o:0;c>f;f++){var m=u[f];if(m.selected){var p=m.value;if(p||(p=m.attributes&&m.attributes.value&&!m.attributes.value.specified?m.text:m.value),l)return p;s.push(p)}}return s}return e(t).val()},e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})},e.fn.clearFields=e.fn.clearInputs=function(t){var r=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var a=this.type,n=this.tagName.toLowerCase();r.test(a)||"textarea"==n?this.value="":"checkbox"==a||"radio"==a?this.checked=!1:"select"==n?this.selectedIndex=-1:"file"==a?/MSIE/.test(navigator.userAgent)?e(this).replaceWith(e(this).clone(!0)):e(this).val(""):t&&(t===!0&&/hidden/.test(a)||"string"==typeof t&&e(this).is(t))&&(this.value="")})},e.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})},e.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},e.fn.selected=function(t){return void 0===t&&(t=!0),this.each(function(){var r=this.type;if("checkbox"==r||"radio"==r)this.checked=t;else if("option"==this.tagName.toLowerCase()){var a=e(this).parent("select");t&&a[0]&&"select-one"==a[0].type&&a.find("option").selected(!1),this.selected=t}})},e.fn.ajaxSubmit.debug=!1})(jQuery);

/*
 * Color plugin
 */
(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(!g.colorInit){g.start=c(g.elem,e);g.end=b(g.end);g.colorInit=true}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.css(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);

/* jQuery Serialize object */
$.fn.serializeObject = function()
{
  var o = {};
  var a = this.serializeArray();
  $.each(a, function() {
    if (o[this.name] !== undefined) {
      if (!o[this.name].push) {
        o[this.name] = [o[this.name]];
      }
      o[this.name].push(this.value || '');
    } else {
      o[this.name] = this.value || '';
    }
  });
  return o;
};

/*
  Namespace
 */
window.imoney = window.imoney || {};
imoney.urls = imoney.urls || {};

imoney.browser = {
  //flashEnabled: !!(navigator.mimeTypes["application/x-shockwave-flash"] || window.ActiveXObject && new ActiveXObject('ShockwaveFlash.ShockwaveFlash')),
  flashEnabled: true,
  isMobile: false
};

imoney.cookie = {
  create: function(name,value,days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
  },

  read: function(name, defaultValue) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return defaultValue || null;
  },

  erase: function(name) {
    createCookie(name,"",-1);
  }
};

/**
 * Заменяет строку с переменным {var} значениями из объекта {var: 'value'}.
 */
imoney.curlyTemplate = {
  fetch: function(template, data)
  {
    return template.replace(/{(.+?)}/gi, function(placeholder, match, position, raw){
      return data[match] || '';
    });
  }
};

/**
 * Выводит промо-ролик.
 */
imoney.reelDisplay = (function()
{
  var swfHTML = '<object  wmode="transparent" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="{width}" height="{height}" id="{id}" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="allowFullScreen" value="false" /><param name="movie" value="{url}" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="{url}" quality="high" bgcolor="#ffffff" width="{width}" height="{height}" name="{name}" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.adobe.com/go/getflashplayer" /></object>';
  var videoHTML = '<video class="video-js vjs-default-skin" width="{width}" height="{height}" preload="{preload}" autoplay="" controls=""><source src="{mp4}" type="video/mp4"></source><source src="{webm}" type="video/webm"></source></video>';

  var inheritOptions = ['id', 'height', 'name', 'width'];
  var settings ={
    // Reel containers CSS selector
    container: '#reelDisplay',
    forceMobile: false,
    // Выводится при встраивании swf-видео
    id: 'reel',
    height: 0,
    name: '',
    swf: {
      url: ''
    },
    video: {
      mp4: '',
      preload: 'auto',
      webm: ''
    },
    width: 0,
  };

  return {
    write: function(options)
    {
      options = $.extend(settings, options);

      var html, data;
      if (imoney.browser.flashEnabled && !options.forceMobile
        && !imoney.browser.isMobile && options.swf.url) {
        html = swfHTML;
        data = options.swf
      } else if (options.video.mp4 || options.video.webm) {
        html = videoHTML;
        data = options.video;
      }
      if (html) {
        $.each(inheritOptions, function(index, name){
          if (typeof data[name] == 'undefined') {
            data[name] = options[name];
          }
        });
        $(options.container).html(imoney.curlyTemplate.fetch(html, data));
      }
    }
  }
})();

var locationSearch = (function(){
  var prmstr = window.location.search.substr(1);
  var prmarr = prmstr.split ("&");
  var params = {};

  for ( var i = 0; i < prmarr.length; i++) {
    var tmparr = prmarr[i].split("=");
    params[tmparr[0]] = tmparr[1];
  }

  return params;
})();

/**
 Signup Form Plugin
 */
(function($){
  var pluginName = 'signupForm';
  var methods = {
    'init': function(options) {
      return this.each(function(){
        var $this = $(this),
          data = $this.data(pluginName);

        var settings = $.extend({
          // Defaults
        }, options);

        if (!data){
          $('.submit').click(function(event){
            event.preventDefault();
            $this.submit();
          });

          $this.submit(function(event){
            if (!$this.data('isValid')) {
              event.preventDefault();
              validateForm($this);
            }
          });

          $(this).data(pluginName, {
            target : $this,
            settings: settings
          });
        }
      });
    }
  };

  $.fn[pluginName] = function(method){
    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.' + pluginName );
    }
  };
})(jQuery);

/**
 * Contact Form Plugin
 */
(function($){
  var pluginName = 'contactForm';
  var methods = {
    'init': function(options) {
      return this.each(function(){
        var $this = $(this),
          data = $this.data(pluginName);

        var settings = $.extend({
          // Defaults
          captchaURL: '/get-captcha/',
          onSuccess: false
        }, options);

        if (!data){
          /* Plugin body */
          $this.submit(function(event){
            event.preventDefault();
            var $cbx = $('input[name="is_email_correct"]', $this);
            var $email = $('#email', $this);
            var $repeatEmail = $('#repeat_email', $this);

            var errors = [];

            if($cbx.length && !$cbx.is(':checked')){
              errors.push($('label[for="' + $cbx.attr('id') + '"]', $this).text());
            }

            if($repeatEmail.length && $email.length && $email.val() != $repeatEmail.val()){
              errors.push('Введенные емайлы не совпадают.');
            }

            if (!errors.length) {
              formSubmitHandler($this, settings.onSuccess);
            } else {
              alert(errors.join("\n"));
            }
          });

          $container = $this.parent();
          /* /Plugin body */

          $(this).data(pluginName, {
            target : $this,
            settings: settings,

            container: $container
          });
        }
      });
    }
  };

  function formSubmitHandler($form, callback)
  {
    $('.control-group', $form).removeClass('error');
    var $container = $form.data(pluginName).container;
    var $message = $container.find('.alert');
    if (!$message.length) {
      $message = $('.alert');
    }
    $message.hide();
    $.post($form.attr('action'), $form.serialize(),
      function(data){
        if(data.ok){
          $message.addClass('alert-success').removeClass('alert-error');
          $message.html(data.message);

          if(callback && typeof callback == 'function'){
            callback();
          }

          resetForm($form);
        } else {
          var errors_str = '<ul>';
          $message.addClass('alert-error').removeClass('alert-success');
          for(i in data.errors){
            errors_str += '<li>' + data.errors[i] + '</li>';
            $form.find('*[name="' + i + '"]').parents('.control-group').addClass('error');
          }
          errors_str += '</ul>';
          $message.html(errors_str);
        }
        $message.show();
        $('http://paleo-dieta.info/js/ipro/input, textarea, select, .btn', $form).removeAttr('disabled');
        $('.ico-loading', $form).css({visibility: 'hidden'});
      },
      'json');
    $('http://paleo-dieta.info/js/ipro/input, textarea, select, .btn', $form).attr('disabled', 'disabled');
    $('.ico-loading', $form).css({visibility: 'visible'});
  }

  /**
   * @private
   */
  function reloadCaptcha(captchURL){
    $('#icp').attr('src', captchURL + '?' + Math.floor(Math.random()*10));
  }

  /**
   * @private
   */
  function resetForm($form){
    $('input[type="text"], input:file, textarea', $form).val('');
    reloadCaptcha($form.data(pluginName).settings.captchaURL);
  }

  $.fn[pluginName] = function(method){
    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.' + pluginName );
    }
  };
})(jQuery);

/**
 * Очередной плагин для формы...
 */
(function($){
  var pluginName = 'expressForm';

  var methods = {
    'init': function(options) {
      return this.each(function(){
        var $this = $(this),
          data = $this.data(pluginName);

        var $form = $this.is('form') ? $this : $this.find('form:first');
        var $container = $this.is('form') ? $this.parent() : $this;

        var settings = $.extend({
          // Defaults
          captchaURL: '/get-captcha/',
          onSuccess: false,
          successURL: ''
        }, options);

        if (!data){
          /* Plugin body */
          $form.submit(function(event){
            event.preventDefault();
            $.post($form.attr('action'), $form.serialize(), function(response){
              if(response.ok){
                if (typeof settings.onSuccess == 'function') {
                  settings.onSuccess();
                }

                exitPopup.skip();
                window.top.location = settings.successURL;
              } else {
                alert(response.errors.join("\n"));
                $form.find('input').removeAttr('disabled');
              }
            }, 'json');
            $form.find('input').attr('disabled', 'disabled');
          });

          /* /Plugin body */

          $(this).data(pluginName, {
            target : $this,
            settings: settings,

            container: $container,
            form: $form
          });
        }
      });
    }
  };

  $.fn[pluginName] = function(method){
    if ( methods[method] ) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.' + pluginName );
    }
  };
})(jQuery);

var ScrollDirection = (function () {
  var previousTop = 0;
  /**
   * 0 - top, 1 - down
   */
  var scrollDirection = 1;

  function track() {
    var currentTop = parseInt($(window).scrollTop());
    scrollDirection = currentTop < previousTop ? 0 : 1;
    previousTop = currentTop;
  }

  $(window).on('scroll', track);

  return {
    isDown: function () {
      return scrollDirection == 1;
    },

    isUp: function () {
      return scrollDirection === 0;
    }
  };
})();

(function ($) {
  $.fn.stayVisible = function (options) {
    var version = '2.0';

    return this.each(function () {
      var $this = $(this);
      var $container = false;
      var settings = $.extend({
        // Defaults
        // Контейнер, ограничивающий движение вниз
        container: false,
        marginBottom: 20,
        marginTop: 20
      }, options);

      if (settings.container) {
        $container = $(settings.container);
        if (!$container.length) {
          $container = false;
        }
      }

      $this.css({position: 'absolute'});

      function checkPosition() {
        var top = $this.offset().top;
        var height = $this.outerHeight();
        var newTop = false;

        var windowTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var windowBottom = windowTop + windowHeight;

        var bottomInvisible = top + height + settings.marginBottom < windowBottom;
        var topInvisible = top - settings.marginTop < windowTop;

        var mightTop = windowTop + settings.marginTop;
        var mightBottom = windowBottom - settings.marginBottom - height

        if (ScrollDirection.isDown() && bottomInvisible) {
          if (height >= windowHeight) {
            newTop = mightBottom;
          } else if (height < windowHeight && topInvisible) {
            newTop = mightTop;
          }
          if ($container && (newTop + height + settings.marginBottom > $container.offset().top + $container.innerHeight())) {
            newTop = $container.offset().top + $container.innerHeight() - height - settings.marginBottom;
          }
        } else if (ScrollDirection.isUp()) {
          if (top > windowTop + settings.marginTop) {
            newTop = mightTop;
          }

          if (newTop && newTop < $this.parent().offset().top) {
            newTop = $this.parent().offset().top;
          }
        }

        if (newTop !== false) {
          $this.offset({top: newTop});
        }
      }

      $(window).on('scroll', checkPosition);
    });
  };
})(jQuery);

(function($){
  $.fn.simpleCountdown = function(options)
  {
    var settings = {
      // Seconds
      'alertPeriod': 0,

      // Seconds
      'timeLeft': 10,
      'onAlert': null,
      'onComplete': null
    };
    return this.each(function(){
      if (options) {
        $.extend(settings, options);
      }

      var $container = $(this);

      function doCountdown(){
        settings.timeLeft--;
        if(settings.alertPeriod && settings.timeLeft == settings.alertPeriod){
          if(settings.onAlert){
            settings.onAlert();
          }
        }
        if(settings.timeLeft == 60){
          $container.css({color: '#f00'});
        }
        if(settings.timeLeft < 0){
          clearInterval(interval);
          if(settings.onComplete){
            settings.onComplete();
          }
        } else {
          write();
        }
      }

      function write(){
        var hours = Math.floor(settings.timeLeft / (60 * 60));
        var t = settings.timeLeft - hours * 60 * 60;
        var minutes = Math.floor(t / 60);
        var seconds = t % 60;

        var html = '';
        if (hours) {
          html += hours + ':';
        }

        if(minutes < 10) {minutes = '0' + minutes; }
        if(seconds < 10) {seconds = '0' + seconds; }
        $container.html(html + minutes + ':' + seconds);
      }

      write();
      var interval = setInterval(doCountdown, 1000);
    });
  };
})(jQuery);

(function($) {
  $.fn.highlight = function(options) {

    var settings = {
      backgroundColor: '#ffffcc',
      hold: 5,
      speedIn: .3,
      speedOut: 2
    };

    return this.each(function(){
      if (options) {
        $.extend(settings, options);
      }

      var $this = $(this);
      var bgColor = $this.css('backgroundColor');

      $this
        .animate({
          backgroundColor: settings.backgroundColor
        }, settings.speedIn * 1000)
        .delay(settings.hold * 1000)
        .animate({
          backgroundColor: bgColor
        }, settings.speedOut * 1000);
    });
  }
})(jQuery);

/**
 *  Позволяет показывать попап при выходе пользователя.
 *  Новые браузеры не позволяют модифицировать текст, выводящийся
 *  на подтверждении закрытия страницы, поэтому сначала выводится алерт.
 *
 *  TODO Добавить проверку на версию браузера, для старых алерт не нужно показывать.
 *  TODO Вернуть костыль для старых ИЕ, см. static/dont_go_away/index.php
 *
 *  @version 2.0.1
 */
var exitPopup = (function()
{
  var _settings = {
    /**
     * Сообщение, выводящееся перед браузерным предупреждением о закрытии.
     * Нужно указывать для новых браузеров.
     */
    alertMessage: '',

    /**
     * Хэш тип файла - ссылка на файл.
     * <code>
     *   audio: {
       *     mp3: '',
       *     ogg: ''
       *   },
     * </code>
     */
    audio: false,

    /**
     * Сообщение, встраиваемое в браузерное предупреждение о закрытии.
     * Доступно только для старых браузеров.
     */
    confirmMessage: '',

    onShow: false,

    /**
     * Адрес страницы, которая будет встроена поверх основной.
     */
    url: '',
    frameName: 'exitFrame',
    pageContainerSelector: 'body'
  };
  var _exitContainer;
  var _exitFrame;
  var _pageContainer;
  var _skip = false;
  var _version = "2.0.1";
  var _window;

  var $audio = false;

  var types = {
    mp3: 'audio/mpeg',
    ogg: 'audio/ogg'
  };

  function _beforeUnloadHandler()
  {
    if(!_skip){
      _public.skip();

      _exitContainer.show();
      _pageContainer.hide();

      $('object, embed, video').remove();

      if (typeof _settings.onShow == 'function') {
        _settings.onShow();
      }

      if ($audio) {
        $audio.trigger('play');
      }

      alert(_settings.alertMessage);
      return _settings.confirmMessage;
    }
  }

  function _injectAudio()
  {
    if (typeof _settings.audio == 'object') {
      $audio = $('<audio preload="auto" />');
      for (var type in _settings.audio) {
        if (typeof types[type] == 'undefined') {
          continue;
        }
        $('<source src="' + _settings.audio[type] + '" type="' + types[type] + '" />')
          .appendTo($audio);
      }

      _exitContainer.after($audio);
    }
  }

  function _injectExitPage()
  {
    _exitContainer = $('<div class="exitContainer" style="display: none; height: 100%; position: fixed; top: 0px; left: 0px; width: 100%; z-index: 9999; "></div>');
    _exitFrame = $('<iframe name="' + _settings.frameName + '" src="' + _settings.url + '" frameborder="0" style="height: 100%; width: 100%; "></iframe>');

    _exitContainer.append(_exitFrame);
    _pageContainer.before(_exitContainer);
  }

  function _skipClickHandler(event)
  {
    _public.skip();
  }

  var _public = {
    init: function(options)
    {
      for (var p in options) {
        if (options.hasOwnProperty(p) && _settings.hasOwnProperty(p)) {
          _settings[p] = options[p];
        }
      }

      if (_settings.url) {
        _window = $(window);
        _pageContainer = $(_settings.pageContainerSelector);

        // Встраиваем фрейм.
        _injectExitPage();
        _injectAudio();

        $(window).bind('beforeunload', _beforeUnloadHandler);
        // Отключаем отображение ифрейма при переходе по ссылке или самбите формы.
        $(document).bind('click submit', _skipClickHandler);
      }
    },

    skip: function()
    {
      _skip = true;
    }
  };

  return _public;
})();

function validateForm($form)
{
  var $field;
  var $errorField = false;
  var errors = [];

  var mandatory = [
    {selector: 'input[name="first_name"]', message: 'Укажите своё имя.'},
    {selector: '#email', message: 'Укажите электронный адрес.'},
    {selector: '[name="sex"]', message: 'Укажите пол.'},
    {selector: '#birthyear', message: 'Выберите свой год рождения.'}
  ];

  var termsMessage = 'Пожалуйста, поставьте галочку о согласии с правилами сайта';

  $.each(mandatory, function(){
    $field = $(this.selector);
    if (!$field.val()
      || ($field.is('select') && !parseInt($field.find('option:selected').val()))
      || ($field.is(':radio') && !$field.filter(':checked').length)
      ) {
      $field.closest('.control-group').addClass('error');
      if(!$errorField){
        $errorField = $field;
      }
      errors.push(this.message);
    } else {
      $field.closest('.control-group').removeClass('error');
    }
  });

  var $cbx = $('input[name="isAccepted"]', $form);
  if ($cbx.length && !$cbx.is(':checked')) {
    errors.push(termsMessage);
  }

  if(errors.length){
    $errorField.focus();
    alert(errors.join("\n"));
    return false;
  }

  $('#signupForm').data('isValid', 1);

  var $dialog = $('#waitDialog');
  if ($dialog.length) {
    $('#blackout').show();
    $dialog.show();

    setTimeout(function(){
      exitPopup.skip();
      $('#signupForm').submit();
    }, 5000);
  } else {
    exitPopup.skip();
    $('#signupForm').submit();
  }
};

$(function(){
  /* Skip upsell */
  $('.skip-upsell a.disabled').live('click', function(event){
    event.preventDefault();
  });

  $('.skip-upsell input:checkbox').change(function(event){
    var $button = $('.skip-upsell a.btn');
    if ($(this).is(':checked')) {
      $button.removeClass('disabled');
    } else {
      $button.addClass('disabled');
    }
  });
  /* // Skip upsell */

  /* Verify header */
  var $verifyBox = $('.verify-header');
  var $actionsBox = $('.actions', $verifyBox);
  $('http://paleo-dieta.info/js/ipro/a.btn', $actionsBox).click(function(event){
    event.preventDefault();

    var action = $(this).data('action');

    $actionsBox.hide();
    $('.action-box', $verifyBox).hide();
    $('.' + action + '-box')
      .show()
      .find('input:first').focus();
  });

  $('a[data-action="cancel"]').click(function(event){
    event.preventDefault();
    $actionsBox.show();
    $('.action-box', $verifyBox).hide();
  });

  $('#quickEmailEdit, #requestResend').ajaxForm({
    beforeSubmit: function(data, $form, options)
    {
      var isValid = true;

      if (isValid) {
        ajaxFormLoading($form, true);
      }

      return isValid;
    },
    dataType: 'json',
    error: function(response, statusText, xhr, $form)
    {
      ajaxFormLoading($form, false);
    },
    success: function(response, statusText, xhr, $form)
    {
      ajaxFormLoading($form, false);

      if (response.ok) {
        if (response.data.html) {
          $('.verify-header .copy').html(response.data.html);
        }

        $('.actions, .action-box', $verifyBox).hide();
        $form.resetForm();
      } else if (response.errors && response.errors.length) {
        alert(response.errors.join("\n"));
        $('input:first', $form).focus();
      }
    }
  });

  function ajaxFormLoading($form, isOn)
  {
    var $actions = $('.form-actions', $form);
    if (isOn) {
      $actions.find('*').hide().filter('.loading').show();
    } else {
      $actions.find('*').hide().filter(':not(.loading)').show();
    }
  }
  /* // Verify header */
});
