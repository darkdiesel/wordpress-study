var _e=Object.defineProperty,Oe=Object.defineProperties;var $e=Object.getOwnPropertyDescriptors;var A=Object.getOwnPropertySymbols;var De=Object.prototype.hasOwnProperty,Ee=Object.prototype.propertyIsEnumerable;var M=(e,n,r)=>n in e?_e(e,n,{enumerable:!0,configurable:!0,writable:!0,value:r}):e[n]=r,v=(e,n)=>{for(var r in n||(n={}))De.call(n,r)&&M(e,r,n[r]);if(A)for(var r of A(n))Ee.call(n,r)&&M(e,r,n[r]);return e},j=(e,n)=>Oe(e,$e(n));import{s as Te}from"./js/client.93f15631.js";var O={exports:{}},N={};/*
object-assign
(c) Sindre Sorhus
@license MIT
*/var V=Object.getOwnPropertySymbols,Fe=Object.prototype.hasOwnProperty,Re=Object.prototype.propertyIsEnumerable;function We(e){if(e==null)throw new TypeError("Object.assign cannot be called with null or undefined");return Object(e)}function Be(){try{if(!Object.assign)return!1;var e=new String("abc");if(e[5]="de",Object.getOwnPropertyNames(e)[0]==="5")return!1;for(var n={},r=0;r<10;r++)n["_"+String.fromCharCode(r)]=r;var o=Object.getOwnPropertyNames(n).map(function(l){return n[l]});if(o.join("")!=="0123456789")return!1;var t={};return"abcdefghijklmnopqrst".split("").forEach(function(l){t[l]=l}),Object.keys(Object.assign({},t)).join("")==="abcdefghijklmnopqrst"}catch{return!1}}var Le=Be()?Object.assign:function(e,n){for(var r,o=We(e),t,l=1;l<arguments.length;l++){r=Object(arguments[l]);for(var i in r)Fe.call(r,i)&&(o[i]=r[i]);if(V){t=V(r);for(var s=0;s<t.length;s++)Re.call(r,t[s])&&(o[t[s]]=r[t[s]])}}return o},q={exports:{}},u={};/** @license React v17.0.2
 * react.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */var F=Le,z=60103,Y=60106;u.Fragment=60107;u.StrictMode=60108;u.Profiler=60114;var J=60109,K=60110,Q=60112;u.Suspense=60113;var X=60115,ee=60116;if(typeof Symbol=="function"&&Symbol.for){var p=Symbol.for;z=p("react.element"),Y=p("react.portal"),u.Fragment=p("react.fragment"),u.StrictMode=p("react.strict_mode"),u.Profiler=p("react.profiler"),J=p("react.provider"),K=p("react.context"),Q=p("react.forward_ref"),u.Suspense=p("react.suspense"),X=p("react.memo"),ee=p("react.lazy")}var I=typeof Symbol=="function"&&Symbol.iterator;function Ae(e){return e===null||typeof e!="object"?null:(e=I&&e[I]||e["@@iterator"],typeof e=="function"?e:null)}function k(e){for(var n="https://reactjs.org/docs/error-decoder.html?invariant="+e,r=1;r<arguments.length;r++)n+="&args[]="+encodeURIComponent(arguments[r]);return"Minified React error #"+e+"; visit "+n+" for the full message or use the non-minified dev environment for full errors and additional helpful warnings."}var ne={isMounted:function(){return!1},enqueueForceUpdate:function(){},enqueueReplaceState:function(){},enqueueSetState:function(){}},ae={};function S(e,n,r){this.props=e,this.context=n,this.refs=ae,this.updater=r||ne}S.prototype.isReactComponent={};S.prototype.setState=function(e,n){if(typeof e!="object"&&typeof e!="function"&&e!=null)throw Error(k(85));this.updater.enqueueSetState(this,e,n,"setState")};S.prototype.forceUpdate=function(e){this.updater.enqueueForceUpdate(this,e,"forceUpdate")};function te(){}te.prototype=S.prototype;function R(e,n,r){this.props=e,this.context=n,this.refs=ae,this.updater=r||ne}var W=R.prototype=new te;W.constructor=R;F(W,S.prototype);W.isPureReactComponent=!0;var B={current:null},re=Object.prototype.hasOwnProperty,oe={key:!0,ref:!0,__self:!0,__source:!0};function le(e,n,r){var o,t={},l=null,i=null;if(n!=null)for(o in n.ref!==void 0&&(i=n.ref),n.key!==void 0&&(l=""+n.key),n)re.call(n,o)&&!oe.hasOwnProperty(o)&&(t[o]=n[o]);var s=arguments.length-2;if(s===1)t.children=r;else if(1<s){for(var c=Array(s),w=0;w<s;w++)c[w]=arguments[w+2];t.children=c}if(e&&e.defaultProps)for(o in s=e.defaultProps,s)t[o]===void 0&&(t[o]=s[o]);return{$$typeof:z,type:e,key:l,ref:i,props:t,_owner:B.current}}function Me(e,n){return{$$typeof:z,type:e.type,key:n,ref:e.ref,props:e.props,_owner:e._owner}}function L(e){return typeof e=="object"&&e!==null&&e.$$typeof===z}function je(e){var n={"=":"=0",":":"=2"};return"$"+e.replace(/[=:]/g,function(r){return n[r]})}var Z=/\/+/g;function $(e,n){return typeof e=="object"&&e!==null&&e.key!=null?je(""+e.key):n.toString(36)}function _(e,n,r,o,t){var l=typeof e;(l==="undefined"||l==="boolean")&&(e=null);var i=!1;if(e===null)i=!0;else switch(l){case"string":case"number":i=!0;break;case"object":switch(e.$$typeof){case z:case Y:i=!0}}if(i)return i=e,t=t(i),e=o===""?"."+$(i,0):o,Array.isArray(t)?(r="",e!=null&&(r=e.replace(Z,"$&/")+"/"),_(t,n,r,"",function(w){return w})):t!=null&&(L(t)&&(t=Me(t,r+(!t.key||i&&i.key===t.key?"":(""+t.key).replace(Z,"$&/")+"/")+e)),n.push(t)),1;if(i=0,o=o===""?".":o+":",Array.isArray(e))for(var s=0;s<e.length;s++){l=e[s];var c=o+$(l,s);i+=_(l,n,r,c,t)}else if(c=Ae(e),typeof c=="function")for(e=c.call(e),s=0;!(l=e.next()).done;)l=l.value,c=o+$(l,s++),i+=_(l,n,r,c,t);else if(l==="object")throw n=""+e,Error(k(31,n==="[object Object]"?"object with keys {"+Object.keys(e).join(", ")+"}":n));return i}function x(e,n,r){if(e==null)return e;var o=[],t=0;return _(e,o,"","",function(l){return n.call(r,l,t++)}),o}function Ve(e){if(e._status===-1){var n=e._result;n=n(),e._status=0,e._result=n,n.then(function(r){e._status===0&&(r=r.default,e._status=1,e._result=r)},function(r){e._status===0&&(e._status=2,e._result=r)})}if(e._status===1)return e._result;throw e._result}var se={current:null};function b(){var e=se.current;if(e===null)throw Error(k(321));return e}var Ie={ReactCurrentDispatcher:se,ReactCurrentBatchConfig:{transition:0},ReactCurrentOwner:B,IsSomeRendererActing:{current:!1},assign:F};u.Children={map:x,forEach:function(e,n,r){x(e,function(){n.apply(this,arguments)},r)},count:function(e){var n=0;return x(e,function(){n++}),n},toArray:function(e){return x(e,function(n){return n})||[]},only:function(e){if(!L(e))throw Error(k(143));return e}};u.Component=S;u.PureComponent=R;u.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED=Ie;u.cloneElement=function(e,n,r){if(e==null)throw Error(k(267,e));var o=F({},e.props),t=e.key,l=e.ref,i=e._owner;if(n!=null){if(n.ref!==void 0&&(l=n.ref,i=B.current),n.key!==void 0&&(t=""+n.key),e.type&&e.type.defaultProps)var s=e.type.defaultProps;for(c in n)re.call(n,c)&&!oe.hasOwnProperty(c)&&(o[c]=n[c]===void 0&&s!==void 0?s[c]:n[c])}var c=arguments.length-2;if(c===1)o.children=r;else if(1<c){s=Array(c);for(var w=0;w<c;w++)s[w]=arguments[w+2];o.children=s}return{$$typeof:z,type:e.type,key:t,ref:l,props:o,_owner:i}};u.createContext=function(e,n){return n===void 0&&(n=null),e={$$typeof:K,_calculateChangedBits:n,_currentValue:e,_currentValue2:e,_threadCount:0,Provider:null,Consumer:null},e.Provider={$$typeof:J,_context:e},e.Consumer=e};u.createElement=le;u.createFactory=function(e){var n=le.bind(null,e);return n.type=e,n};u.createRef=function(){return{current:null}};u.forwardRef=function(e){return{$$typeof:Q,render:e}};u.isValidElement=L;u.lazy=function(e){return{$$typeof:ee,_payload:{_status:-1,_result:e},_init:Ve}};u.memo=function(e,n){return{$$typeof:X,type:e,compare:n===void 0?null:n}};u.useCallback=function(e,n){return b().useCallback(e,n)};u.useContext=function(e,n){return b().useContext(e,n)};u.useDebugValue=function(){};u.useEffect=function(e,n){return b().useEffect(e,n)};u.useImperativeHandle=function(e,n,r){return b().useImperativeHandle(e,n,r)};u.useLayoutEffect=function(e,n){return b().useLayoutEffect(e,n)};u.useMemo=function(e,n){return b().useMemo(e,n)};u.useReducer=function(e,n,r){return b().useReducer(e,n,r)};u.useRef=function(e){return b().useRef(e)};u.useState=function(e){return b().useState(e)};u.version="17.0.2";q.exports=u;/** @license React v17.0.2
 * react-jsx-runtime.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */var Ze=q.exports,ie=60103;N.Fragment=60107;if(typeof Symbol=="function"&&Symbol.for){var U=Symbol.for;ie=U("react.element"),N.Fragment=U("react.fragment")}var Ue=Ze.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,Ge=Object.prototype.hasOwnProperty,qe={key:!0,ref:!0,__self:!0,__source:!0};function ce(e,n,r){var o,t={},l=null,i=null;r!==void 0&&(l=""+r),n.key!==void 0&&(l=""+n.key),n.ref!==void 0&&(i=n.ref);for(o in n)Ge.call(n,o)&&!qe.hasOwnProperty(o)&&(t[o]=n[o]);if(e&&e.defaultProps)for(o in n=e.defaultProps,n)t[o]===void 0&&(t[o]=n[o]);return{$$typeof:ie,type:e,key:l,ref:i,props:t,_owner:Ue.current}}N.jsx=ce;N.jsxs=ce;O.exports=N;const a=O.exports.jsx,d=O.exports.jsxs,T=O.exports.Fragment,m={};m.headline=d("svg",{width:24,height:24,viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:[a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M15.817 2H22v.038l-6.183 4.226V2.001zm-7.62 9.473V2H2.016v4.683-.267l6.126 5.094.057-.038zm-6.182 5.061l6.183 4.213v1.252H2.015v-5.465zm13.802-.857L22 11.559v10.437h-6.183v-6.32z",fill:"#141B38"}),a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M8.198 11.435l-.057.039L2.016 6.38v.265-4.644h6.182v9.434zm0 9.226L2.015 16.45v5.55h6.183v-1.337zm7.62-5.07L22 11.474v10.522h-6.183v-6.405zM22 2.001l-6.183 4.226V2H22z",fill:"#141B38"}),a("path",{d:"M8.141 13.537L22 4.064v5.432l-13.8 9.19L2 14.46l.016-6.018 6.125 5.094z",fill:"#141B38"})]});m.headlineBlack=a("svg",{width:"15",height:"14",viewBox:"0 0 15 14",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{d:"M13.5 2V12H14.5C14.6458 12 14.7604 12.0521 14.8438 12.1562C14.9479 12.2396 15 12.3542 15 12.5V13.5C15 13.6458 14.9479 13.7604 14.8438 13.8438C14.7604 13.9479 14.6458 14 14.5 14H9.5C9.35417 14 9.22917 13.9479 9.125 13.8438C9.04167 13.7604 9 13.6458 9 13.5V12.5C9 12.3542 9.04167 12.2396 9.125 12.1562C9.22917 12.0521 9.35417 12 9.5 12H10.5V8H4.5V12H5.5C5.64583 12 5.76042 12.0521 5.84375 12.1562C5.94792 12.2396 6 12.3542 6 12.5V13.5C6 13.6458 5.94792 13.7604 5.84375 13.8438C5.76042 13.9479 5.64583 14 5.5 14H0.5C0.354167 14 0.229167 13.9479 0.125 13.8438C0.0416667 13.7604 0 13.6458 0 13.5V12.5C0 12.3542 0.0416667 12.2396 0.125 12.1562C0.229167 12.0521 0.354167 12 0.5 12H1.5V2H0.5C0.354167 2 0.229167 1.95833 0.125 1.875C0.0416667 1.77083 0 1.64583 0 1.5V0.5C0 0.354167 0.0416667 0.239583 0.125 0.15625C0.229167 0.0520833 0.354167 0 0.5 0H5.5C5.64583 0 5.76042 0.0520833 5.84375 0.15625C5.94792 0.239583 6 0.354167 6 0.5V1.5C6 1.64583 5.94792 1.77083 5.84375 1.875C5.76042 1.95833 5.64583 2 5.5 2H4.5V6H10.5V2H9.5C9.35417 2 9.22917 1.95833 9.125 1.875C9.04167 1.77083 9 1.64583 9 1.5V0.5C9 0.354167 9.04167 0.239583 9.125 0.15625C9.22917 0.0520833 9.35417 0 9.5 0H14.5C14.6458 0 14.7604 0.0520833 14.8438 0.15625C14.9479 0.239583 15 0.354167 15 0.5V1.5C15 1.64583 14.9479 1.77083 14.8438 1.875C14.7604 1.95833 14.6458 2 14.5 2H13.5Z",fill:"#000"})});m.warning=a("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM11 5.00002H9V11H11V5.00002ZM11 13H9V15H11V13ZM2.00002 10C2.00002 14.42 5.58002 18 10 18C14.42 18 18 14.42 18 10C18 5.58002 14.42 2.00002 10 2.00002C5.58002 2.00002 2.00002 5.58002 2.00002 10Z",fill:"#005AE0"})});m.smile=a("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM6.5 6C5.67157 6 5 6.67157 5 7.5C5 8.32843 5.67157 9 6.5 9C7.32843 9 8 8.32843 8 7.5C8 6.67157 7.32843 6 6.5 6ZM13.5 6C12.6716 6 12 6.67157 12 7.5C12 8.32843 12.6716 9 13.5 9C14.3284 9 15 8.32843 15 7.5C15 6.67157 14.3284 6 13.5 6ZM6.55 12C7.25 13.19 8.52 14 10 14C11.48 14 12.75 13.19 13.45 12H15.12C14.32 14.05 12.33 15.5 10 15.5C7.67 15.5 5.68 14.05 4.88 12H6.55ZM2 10C2 14.42 5.58 18 10 18C14.42 18 18 14.42 18 10C18 5.58 14.42 2 10 2C5.58 2 2 5.58 2 10Z",fill:"#00AA63"})});m.neutral=a("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM5 7.5C5 6.67157 5.67157 6 6.5 6C7.32843 6 8 6.67157 8 7.5C8 8.32843 7.32843 9 6.5 9C5.67157 9 5 8.32843 5 7.5ZM13.5 6C12.6716 6 12 6.67157 12 7.5C12 8.32843 12.6716 9 13.5 9C14.3284 9 15 8.32843 15 7.5C15 6.67157 14.3284 6 13.5 6ZM7 13.5V12H13V13.5H7ZM2 10C2 14.42 5.58 18 10 18C14.42 18 18 14.42 18 10C18 5.58 14.42 2 10 2C5.58 2 2 5.58 2 10Z",fill:"#005AE0"})});m.negative=a("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.99 0C4.47 0 0 4.48 0 10C0 15.52 4.47 20 9.99 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 9.99 0ZM6.5 6C5.67157 6 5 6.67157 5 7.5C5 8.32843 5.67157 9 6.5 9C7.32843 9 8 8.32843 8 7.5C8 6.67157 7.32843 6 6.5 6ZM13.5 6C12.6716 6 12 6.67157 12 7.5C12 8.32843 12.6716 9 13.5 9C14.3284 9 15 8.32843 15 7.5C15 6.67157 14.3284 6 13.5 6ZM4.88 15.5C5.68 13.45 7.67 12 10 12C12.33 12 14.32 13.45 15.12 15.5H13.45C12.75 14.31 11.48 13.5 10 13.5C8.52 13.5 7.24 14.31 6.55 15.5H4.88ZM2 10C2 14.42 5.58 18 10 18C14.42 18 18 14.42 18 10C18 5.58 14.42 2 10 2C5.58 2 2 5.58 2 10Z",fill:"#DF2A4A"})});m.check=a("svg",{width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg",children:a("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18ZM8 12.17L14.59 5.58L16 7L8 15L4 11L5.41 9.59L8 12.17Z",fill:"#00AA63"})});const de=e=>Te.agent().set("X-WP-Nonce",e).use(n=>{n.on("response",r=>{(r.status===401||r.status===403)&&console.error(r)})}),Ye=e=>e.replace(/^\//,""),ue=e=>e.replace(/\/$/,""),D=e=>ue(e)+"/",he=e=>(e=window.aioseo.data.hasUrlTrailingSlash?D(e):ue(e),D(window.aioseo.urls.restUrl)+D("aioseo/v1")+Ye(e));var fe={exports:{}};/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/(function(e){(function(){var n={}.hasOwnProperty;function r(){for(var o=[],t=0;t<arguments.length;t++){var l=arguments[t];if(!!l){var i=typeof l;if(i==="string"||i==="number")o.push(l);else if(Array.isArray(l)){if(l.length){var s=r.apply(null,l);s&&o.push(s)}}else if(i==="object")if(l.toString===Object.prototype.toString)for(var c in l)n.call(l,c)&&l[c]&&o.push(c);else o.push(l.toString())}}return o.join(" ")}e.exports?(r.default=r,e.exports=r):window.classNames=r})()})(fe);var y=fe.exports;const{Fragment:Je}=window.wp.element,we=e=>{const n=e.barScore,r=e.color;return a(Je,{children:a("div",{className:"aioseo-donut-container",style:{flexDirection:"column"},children:d("svg",{className:"aioseo-donut-score-svg",viewBox:"0 0 33.83098862 33.83098862",xmlns:"http://www.w3.org/2000/svg",children:[a("circle",{className:"aioseo-seo-headline-analyzer-score__background",stroke:"#e8e8eb",strokeWidth:"2",fill:"none",cx:"16.91549431",cy:"16.91549431",r:"15.91549431"}),a("circle",{className:"aioseo-seo-headline-analyzer-score__circle",stroke:r,strokeWidth:"2",strokeDasharray:`${n}, 100`,strokeLinecap:"round",fill:"none",cx:"16.91549431",cy:"16.91549431",r:"15.91549431"})]})})})},{__:sa,sprintf:P}=window.wp.i18n,Ke=P("Headlines that are lists and how-to get more engagement on average than other types of headlines. %1$s%2$sLearn More%3$s \u2192","<br /><br />",'<a href="https://optinmonster.com/why-these-21-headlines-went-viral-and-how-you-can-copy-their-success/" target="_blank" className="aioseo-headline-analyzer-link"><span>',"</span></a>"),ye=P("A very good score is between %1$d and %2$d.",70,90),me=P("For best results, you should strive for %1$d and above.",70),Qe=P("This headline analyzer is part of AIOSEO to help you increase your traffic. %1$sAnalyze your site further here%2$s \u2192%3$s",P('<a href="%1$s" className="aioseo-headline-analyzer-link" target="_blank"><span>',window.aioseo.urls.aio.seoAnalysis),"</span>","</a>");window.wp.i18n;const{Fragment:Xe}=window.wp.element,{PanelBody:en,PanelRow:nn}=window.wp.components,an=e=>{const n=e.analyzer.currentHeadlineData.sentence,r="Score",o=e.analyzer.currentHeadlineData.score,t=40>o?"red":70>=o?"orange":"green",l=t==="red"?"#df2a4a":t==="orange"?"#F2994A":"#00aa63";let i;switch(!0){case 25>o:i=a("span",{children:"Not Looking Great"});break;case 50>o:i=a("span",{children:"Could Be Better"});break;case 60>o:i=a("span",{children:"Getting There"});break;case 75>o:i=a("span",{children:"Looks Good! \u{1F44D}\u{1F44D}"});break;case 75<o:i=a("span",{children:"Super! \u{1F525}\u{1F525}\u{1F525}"});break;default:i=!1}return a(Xe,{children:a(en,{className:"aioseo-headline-analyzer-panel-score",title:r,children:a(nn,{children:d("div",{className:"aioseo-headline-analyzer-current-score-tab aioseo-headline-analyzer-panel-first-block",children:[d("h4",{className:"aioseo-headline-analyzer-current-title",children:["\u201C",n,"\u201D"]}),d("div",{className:"aioseo-headline-analyzer-pie-chart-container",children:[d("div",{className:y("aioseo-headline-analyzer-current-score",t),children:[o,a("span",{className:"aioseo-headline-analyzer-total-out-of-score",children:"/ 100"})]}),i&&a("div",{className:y("aioseo-headline-analyzer-score-status",t),children:i}),a(we,{barScore:o,color:l})]}),d("p",{children:[ye," ",me]})]})})})})};window.wp.i18n;const{Fragment:tn}=window.wp.element,{PanelBody:rn,PanelRow:on,TextControl:ln,Button:sn}=window.wp.components,cn=e=>{const n="Try New Headline",r="Enter a different headline than your post title to see how it compares.",o="Analyze Headline",t=typeof e.analyzer.newHeadline!="undefined"?e.analyzer.newHeadline:"",l=typeof e.analyzer.previousHeadlinesData!="undefined"?e.analyzer.previousHeadlinesData:[],i=!t,s=c=>{const w=c.trim();!w||de(window.aioseo.nonce).post(he("analyze_headline")).send({headline:w,shouldStoreHeadline:!1}).then(f=>{const h=JSON.parse(f.body[Object.keys(f.body)[0]]);e.setAnalyzer({newHeadlineData:h,headlineData:h,previousHeadlinesData:[e.analyzer.headlineData,...l],isNewData:!0})}).catch(f=>{e.setAnalyzer({isNewData:!1}),console.log(f)})};return a(tn,{children:a(rn,{title:n,className:y("aioseo-headline-analyzer-panel-tab-new-score-form"),children:a(on,{children:a("div",{className:"aioseo-headline-analyzer-new-tab",children:a("div",{className:"aioseo-headline-analyzer-new-score-form-block",children:d("form",{onSubmit:c=>{c.preventDefault(),s(t)},children:[a(ln,{label:r,value:t,onChange:c=>{c!==" "&&e.setAnalyzer({newHeadline:c})},className:"aioseo-headline-analyzer-input-field"}),a(sn,{className:y("aioseo-headline-analyzer-button"),onClick:()=>{s(t)},disabled:i,children:o})]})})})})})})};window.wp.i18n;const{Fragment:dn}=window.wp.element,{PanelBody:un,PanelRow:hn}=window.wp.components,fn=e=>{const n=e.analyzer.currentHeadlineData.sentence,r="New Score",o="Current Score",t=typeof e.analyzer.newHeadlineData!="undefined"?e.analyzer.newHeadlineData.sentence:"",l=typeof e.analyzer.newHeadlineData!="undefined"?e.analyzer.newHeadlineData.score:"",i=typeof e.analyzer.currentHeadlineData.score!="undefined"?e.analyzer.currentHeadlineData.score:"",s=40>l?"red":60>=l?"orange":"green",c=s==="red"?"#df2a4a":s==="orange"?"#F2994A":"#00aa63",w=40>i?"red-bg":60>=i?"orange-bg":"green-bg",f=Math.abs(l-i);let h;switch(!0){case 25>l:h=a("span",{children:"Not Looking Great"});break;case 50>l:h=a("span",{children:"Could Be Better"});break;case 60>l:h=a("span",{children:"Getting There"});break;case 75>l:h=a("span",{children:"Looks Good! \u{1F44D}\u{1F44D}"});break;case 75<l:h=a("span",{children:"Super! \u{1F525}\u{1F525}\u{1F525}"});break;default:h=!1}return a(dn,{children:a(un,{title:r,className:"aioseo-headline-analyzer-panel-tab-new-score",children:a(hn,{children:a("div",{className:"aioseo-headline-analyzer-panel-first-block",children:d("div",{className:"aioseo-headline-analyzer-new-score-panel",children:[d("p",{children:[ye," ",me]}),d("h4",{children:["\u201C",t,"\u201D"]}),d("div",{className:"aioseo-headline-analyzer-pie-chart-container",children:[a("span",{className:y("aioseo-headline-analyzer-new-score",s),children:l}),a(we,{barScore:l,color:c}),d("span",{className:y("aioseo-headline-analyzer-score-difference",s),children:[l>i?"+ ":l===i?"":"- ",f]}),h&&a("div",{className:y("aioseo-headline-analyzer-score-status",s),children:h})]}),d("div",{className:"current-score",children:[a("span",{className:y("aioseo-headline-analyzer-score",w),children:i}),d("div",{className:"aioseo-headline-analyzer-current-score-content",children:[a("h5",{children:o}),a("p",{children:n})]})]})]})})})})})};window.wp.i18n;const{Fragment:wn,useState:yn,useEffect:mn}=window.wp.element,gn=e=>{const n="Current Score",r="Try New Headline",[o,t]=yn("current-score"),l=()=>t("current-score"),i=()=>t("new-headline"),s=typeof e.analyzer.isNewData!="undefined"?e.analyzer.isNewData:!1;return mn(()=>{e.setAnalyzer({activeTab:o})},[o]),d(wn,{children:[d("div",{className:"aioseo-inline-buttons",children:[a("button",{onClick:l,className:y("aioseo-switcher-button",{active:o==="current-score"}),children:n}),a("button",{onClick:i,className:y("aioseo-switcher-button",{active:o==="new-headline"}),children:r})]}),o==="new-headline"?a(T,{children:a(cn,{analyzer:e.analyzer,setAnalyzer:e.setAnalyzer})}):a(an,{analyzer:e.analyzer}),s?a(fn,{analyzer:e.analyzer}):""]})};window.wp.i18n;const{Fragment:pn}=window.wp.element,{PanelBody:vn,PanelRow:bn}=window.wp.components,Cn=e=>{const n="Previous Scores",r=e.analyzer.previousHeadlinesData!=="undefined"?e.analyzer.previousHeadlinesData:[],o=document.querySelector(".edit-post-sidebar"),l=(e.analyzer.activeTab!=="undefined"?e.analyzer.activeTab:"current-score")==="current-score"?390:300,i=s=>{e.setAnalyzer({newHeadlineData:r[s],headlineData:r[s],newHeadline:r[s].sentence,isNewData:!0}),o&&(o.scrollTop=l)};return a(pn,{children:a(vn,{title:n,className:"aioseo-headline-analyzer-panel-previous-scores",children:a(bn,{children:a("div",{className:"aioseo-headline-analyzer-panel-first-block",children:a("ul",{className:"aioseo-headline-analyzer-previous-scores",children:r.map((s,c)=>{if(10>c&&(typeof s.sentence!="undefined"||typeof s.score!="undefined")){const w=40>s.score?"red-bg":60>=s.score?"orange-bg":"green-bg";return d("li",{onClick:()=>i(c),children:[a("span",{className:y("aioseo-headline-analyzer-score",w),children:s.score}),a("span",{className:"aioseo-headline-analyzer-score-text",children:s.sentence})]},c)}return null})})})})})})};window.wp.i18n;const H=e=>{const n="Goal: ",r={width:e.value+"%"};return d("div",{className:"aioseo-headline-analyzer-words-block",children:[a("h5",{children:e.title}),d("div",{className:"aioseo-headline-analyzer-words-block-data",children:[d("span",{className:y("aioseo-headline-analyzer-words-block-percentage",e.classOnScore),children:[e.value,"%"]}),d("span",{className:y("aioseo-headline-analyzer-words-block-percentage-right-column",e.classOnScore),children:[d("span",{className:"aioseo-headline-analyzer-words-block-goal",children:[n," ",e.goalValue]}),d("span",{className:"aioseo-headline-analyzer-words-block-progressbar",children:[a("span",{className:"aioseo-headline-analyzer-progressbar-bg"}),a("span",{className:y("aioseo-headline-analyzer-progressbar-part",e.classOnScoreBg),style:r})]})]})]}),a("ul",{className:"aioseo-headline-analyzer-words-tag-list",children:0<e.words.length?e.words.map((o,t)=>a("li",{children:o},t)):""}),a("p",{className:"aioseo-headline-analyzer-words-guideline",children:e.guideLine})]})};window.wp.i18n;const{Fragment:zn}=window.wp.element,{PanelBody:Sn,PanelRow:Pn}=window.wp.components,Nn=e=>{const n="Word Balance",r="Compare the percentages of your results to the goal for each category and adjust as necessary.",o=e.data.score,t=40>e.data.score?"red":60>=e.data.score?"orange":"green",l=e.data.result.commonWordsPercentage===0?"red":.2>e.data.result.commonWordsPercentage?"orange":"green",i=e.data.result.commonWordsPercentage===0?"red-bg":.2>e.data.result.commonWordsPercentage?"orange-bg":"green-bg",s=.2>e.data.result.commonWordsPercentage?"Your headline would be more likely to get clicks if it had more common words.":"Headlines with 20-30% common words are more likely to get clicks.",c=e.data.result.uncommonWordsPercentage===0?"red":.1>e.data.result.uncommonWordsPercentage?"orange":"green",w=e.data.result.uncommonWordsPercentage===0?"red-bg":.1>e.data.result.uncommonWordsPercentage?"orange-bg":"green-bg",f=.1>e.data.result.uncommonWordsPercentage?"Your headline would be more likely to get clicks if it had more uncommon words.":"Headlines with uncommon words are more likely to get clicks.",h=e.data.result.emotionalWordsPercentage===0?"red":.1>e.data.result.emotionalWordsPercentage?"orange":"green",g=e.data.result.emotionalWordsPercentage===0?"red-bg":.1>e.data.result.emotionalWordsPercentage?"orange-bg":"green-bg",ge="Emotionally triggered headlines are likely to drive more clicks.",pe=e.data.result.powerWords.length===0?"orange":"green",ve=e.data.result.powerWords.length===0?"orange":"green-bg",be="Headlines with power words are more likely to get clicks.",Ce="Common Words",ze="20-30%",Se="Uncommon Words",Pe="10-20%",Ne="Emotional Words",ke="10-15%",xe="Power Words",He="At least one";let C;switch(!0){case 25>o:C=a("span",{children:"Not Looking Great"});break;case 50>o:C=a("span",{children:"Could Be Better"});break;case 60>o:C=a("span",{children:"Getting There"});break;case 75>o:C=a("span",{children:"Looks Good! \u{1F44D}\u{1F44D}"});break;case 75<o:C=a("span",{children:"Super! \u{1F525}\u{1F525}\u{1F525}"});break;default:C=!1}return a(zn,{children:a(Sn,{title:n,className:y("aioseo-headline-analyzer-panel-word-balance","aioseo-headline-analyzer-panel-has-icon",t),icon:t==="green"?m.check:m.warning,children:d(Pn,{children:[d("div",{className:"aioseo-headline-analyzer-words-block",children:[a("h4",{children:C}),a("p",{children:r})]}),a(H,{title:Ce,value:Math.round(e.data.result.commonWordsPercentage*100),goalValue:ze,words:e.data.result.commonWords,guideLine:s,classOnScore:l,classOnScoreBg:i}),a(H,{title:Se,value:Math.round(e.data.result.uncommonWordsPercentage*100),goalValue:Pe,words:e.data.result.uncommonWords,guideLine:f,classOnScore:c,classOnScoreBg:w}),a(H,{title:Ne,value:Math.round(e.data.result.emotionalWordsPercentage*100),goalValue:ke,words:e.data.result.emotionWords,guideLine:ge,classOnScore:h,classOnScoreBg:g}),a(H,{title:xe,value:Math.round(e.data.result.powerWordsPercentage*100),goalValue:He,words:e.data.result.powerWords,guideLine:be,classOnScore:pe,classOnScoreBg:ve})]})})})};window.wp.i18n;const{Fragment:kn}=window.wp.element,{PanelBody:xn,PanelRow:Hn}=window.wp.components,_n=e=>{const n="Your headline has a neutral sentiment.",r="Headlines that are strongly positive or negative tend to get more engagement then neutral ones.",o="Your headline has a positive sentiment.",t="Positive headlines tend to get better engagement than neutral or negative ones.",l="Your headline has a negative sentiment.",i="Negative headlines are attention-grabbing and tend to perform better than neutral ones.",s="Sentiment",c=e.data.result.sentiment==="neu"?"Neutral":e.data.result.sentiment==="pos"?"Positive":"Negative",w=e.data.result.sentiment==="neu"?m.neutral:e.data.result.sentiment==="pos"?m.smile:m.negative,f=e.data.result.sentiment==="neu"?"orange":e.data.result.sentiment==="pos"?"green":"red";return a(kn,{children:a(xn,{title:s,className:y("aioseo-headline-analyzer-panel-sentiment","aioseo-headline-analyzer-panel-has-icon",f),icon:w,children:a(Hn,{children:d("div",{className:"aioseo-headline-analyzer-panel-first-block",children:[a("h4",{children:c}),e.data.result.sentiment==="neu"?d("p",{children:[a("strong",{children:n}),a("br",{}),r]}):"",e.data.result.sentiment==="pos"?d("p",{children:[a("strong",{children:o}),a("br",{}),t]}):"",e.data.result.sentiment==="neg"?d("p",{children:[a("strong",{children:l}),a("br",{})," ",i]}):""]})})})})};window.wp.i18n;const{Fragment:On}=window.wp.element,{PanelBody:$n,PanelRow:Dn}=window.wp.components,En=e=>{const n=e.data.result.headlineTypes.join(", ");return a(On,{children:a($n,{title:d("span",{className:"aioseo-headline-analyzer-panel-types-title",children:["Headline Type",a("span",{children:n})]}),className:"aioseo-headline-analyzer-panel-types",children:a(Dn,{children:d("div",{className:"aioseo-headline-analyzer-panel-first-block",children:[a("h4",{children:n}),a("p",{dangerouslySetInnerHTML:{__html:Ke}})]})})})})};window.wp.i18n;const{Fragment:Tn}=window.wp.element,{PanelBody:Fn,PanelRow:Rn}=window.wp.components,Wn=e=>{const n="Character Count",r=e.data.result.length,o=r.toString();let t="",l="",i="",s="";if(o.length===1&&(s=`<span class="character-zero">0</span><span class="character-zero">0</span><span>${r}</span>`),o.length===2){s='<span class="character-zero">0</span>';for(const c of o)s+=`<span>${c}</span>`}if(r.toString().length===3)for(const c of o)s+=`<span>${c}</span>`;return 19>=r?t="red":20<=r&&34>=r?t="orange":35<=r&&66>=r?t="green":67<=r&&79>=r?t="orange":80<=r&&(t="red"),34>=r?(l="Too Short \u{1F643}",i="You have space to add more keywords and power words to boost your rankings and click-through rate."):35<=r&&66>=r?(l="Good \u{1F642}",i="Headlines that are about 55 characters long will display fully in search results and tend to get more clicks."):67<=r&&(l="Too Long \u{1F611}",i="At this length, it will get cut off in search results. Try reducing it to about 55 characters."),a(Tn,{children:a(Fn,{title:n,className:y("aioseo-headline-analyzer-panel-character-count","aioseo-headline-analyzer-panel-has-icon",t),icon:t==="green"?m.check:m.warning,children:a(Rn,{children:d("div",{className:"aioseo-headline-analyzer-panel-first-block",children:[d("div",{className:"aioseo-headline-analyzer-character-count-container",children:[a("span",{className:"aioseo-headline-analyzer-status-on-character-length",children:l}),a("span",{className:y("aioseo-headline-analyzer-character-length",t),dangerouslySetInnerHTML:{__html:s}})]}),a("p",{children:i})]})})})})};window.wp.i18n;const{Fragment:Bn}=window.wp.element,{PanelBody:Ln,PanelRow:An}=window.wp.components,Mn=e=>{const n="Word Count",r=e.data.result.wordCount,o=r.toString();let t="",l="",i="",s="";if(o.length===1&&(s=`<span class="character-zero">0</span><span class="character-zero">0</span><span>${r}</span>`),o.length===2){s='<span class="character-zero">0</span>';for(const c of o)s+=`<span>${c}</span>`}if(o.length===3)for(const c of o)s+=`<span>${c}</span>`;return 4>=r?(t="red",l="Not Enough Words \u{1F643}",i="Your headline doesn\u2019t use enough words. You have more space to add keywords and power words to improve your SEO and get more engagement."):5<=r&&9>=r?(t="green",l="Good \u{1F642}",i="Your headline has the right amount of words. Headlines are more likely to be clicked on in search results if they have about 6 words."):10<=r&&11>=r?(t="orange",l="Reduce Word Count \u{1F642}"):(t="red",l="Too Many Words \u{1F611}",i="Your headline has too many words. Long headlines will get cut off in search results and won\u2019t get as many clicks."),a(Bn,{children:a(Ln,{title:n,className:y("aioseo-headline-analyzer-panel-word-count","aioseo-headline-analyzer-panel-has-icon",t),icon:t==="green"?m.check:m.warning,children:a(An,{children:d("div",{className:"aioseo-headline-analyzer-panel-first-block",children:[d("div",{className:"aioseo-headline-analyzer-word-counter",children:[a("span",{className:"aioseo-headline-analyzer-status-on-word-length",children:l}),a("span",{className:y("aioseo-headline-analyzer-word-length",t),dangerouslySetInnerHTML:{__html:s}})]}),a("p",{children:i})]})})})})};window.wp.i18n;const{Fragment:jn}=window.wp.element,{PanelBody:Vn,PanelRow:In}=window.wp.components,Zn=e=>{const n="Beginning & Ending Words",r=e.data.result.originalExplodedHeadline,o="Most readers only look at the first and last 3 words of a headline before deciding whether to click.";let t="",l="";return 6<=r.length?(t=r.slice(0,3).join(" "),l=r.slice(-3).join(" ")):3<r.length&&5>=r.length?(t=r.slice(0,3).join(" "),l=r.slice(3).join(" ")):t=r.slice(0,3).join(" "),a(jn,{children:a(Vn,{title:n,className:"aioseo-headline-analyzer-panel-beginning-ending-words",children:a(In,{children:d("div",{className:"aioseo-headline-analyzer-panel-first-block",children:[t?d(T,{children:[a("ul",{className:"aioseo-headline-analyzer-word-begining-title",children:a("li",{children:"Beginning Words"})}),a("div",{className:"aioseo-headline-analyzer-words beginning",children:a("span",{children:t})})]}):"",l?d(T,{children:[a("ul",{className:"aioseo-headline-analyzer-word-ending-title",children:a("li",{children:"Ending Words"})}),a("div",{className:"aioseo-headline-analyzer-words ending",children:a("span",{children:l})})]}):"",a("p",{className:"aioseo-headline-analyzer-words-guideline",children:o})]})})})})};window.wp.i18n;const{Fragment:Un}=window.wp.element,{PanelBody:Gn,PanelRow:qn}=window.wp.components,{select:Yn}=window.wp.data,Jn=e=>{const n="Search Preview",r="Here is how your headline will look like in Google search results page.",o=Yn("core/editor").getPermalink();return a(Un,{children:a(Gn,{title:n,className:"aioseo-headline-analyzer-panel-search-preview",children:a(qn,{children:a("div",{className:"aioseo-headline-analyzer-panel-first-block",children:d("div",{className:"aioseo-headline-analyzer-search-prevew-wrap",children:[a("p",{className:"aioseo-headline-analyzer-post-url",children:a("a",j(v({},{href:o}),{target:"_blank",children:o}))}),a("h4",{children:e.data.sentence}),a("p",{children:r})]})})})})})};window.wp.i18n;const{Fragment:Kn,useState:Qn,useEffect:Xn}=window.wp.element,{registerPlugin:ea}=window.wp.plugins,{PluginSidebar:na,PluginSidebarMoreMenuItem:aa}=window.wp.editPost,{select:E}=window.wp.data;let G;const ta=(e,n)=>((...r)=>{const o=()=>e(...r);clearTimeout(G),G=setTimeout(o,n)}).call(),ra=()=>{let e=E("core/editor").getEditedPostAttribute("title");const n=()=>{if(!e){const f={dataExist:!1};l(v(v({},t),f));return}de(window.aioseo.nonce).post(he("analyze_headline")).send({headline:e,shouldStoreHeadline:!1}).then(f=>{const h={dataExist:!1},g=JSON.parse(f.body[Object.keys(f.body)[0]]);g.analysed&&(h.currentHeadlineData=g,h.headlineData=g,h.dataExist=!0,typeof t.headlineData!="undefined"&&(h.previousHeadlinesData=[t.headlineData,...i])),l(v(v({},t),h))}).catch(f=>{const h={dataExist:!1};l(v(v({},t),h)),console.log("Couldn't fetch score for headline:",f)})};Xn(()=>n(),[]),window.wp.data.subscribe(()=>{e!==E("core/editor").getEditedPostAttribute("title")&&(e=E("core/editor").getEditedPostAttribute("title"),ta(()=>n(),2e3))});const r="SEO Headline Analyzer",o="Write your post title to see the analyzer data. This Headline Analyzer tool enables you to write irresistible SEO headlines that drive traffic, shares, and rank better in search results.",[t,l]=Qn({}),i=typeof t.previousHeadlinesData!="undefined"?t.previousHeadlinesData:[],s=document.querySelector(`.components-button[aria-label='${r}'] svg`);if(s){const f=document.createElement("span");if(t.dataExist&&typeof t.currentHeadlineData.score!="undefined"){const h=t.currentHeadlineData.score,g=40>h?"red":60>=h?"orange":"green";s.parentNode.setAttribute("aioseo-button-color",g),s.nextElementSibling?s.nextElementSibling.innerHTML=`${h}/100`:(f.innerHTML=`${h}/100`,s.parentNode.insertBefore(f,s.nextSibling))}else s.parentNode.setAttribute("aioseo-button-color","red"),s.nextElementSibling?s.nextElementSibling.innerHTML="00/100":(f.innerHTML="00/100",s.parentNode.insertBefore(f,s.nextSibling))}const c=document.querySelector(".aioseo-headline-analyzer-wrapper");if(c){const f=c.parentNode.querySelectorAll(".components-panel__header");f&&f.forEach(function(h){const g=h.querySelector('[aria-pressed="true"]');g&&g!==null&&(g.style.display="none")})}const w=f=>{l(v(v({},t),f))};return d(Kn,{children:[a(aa,{target:"aioseo-headline-analyzer",children:r}),d(na,{name:"aioseo-headline-analyzer",title:r,className:"aioseo-headline-analyzer-wrapper",children:[typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(gn,{analyzer:t,setAnalyzer:w}):a("p",{className:"aioseo-headline-analyzer-empty-title-warning",children:o}),typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed&&0<i.length?a(Cn,{analyzer:t,setAnalyzer:w}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(Nn,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(_n,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(En,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(Wn,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(Mn,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(Zn,{data:t.headlineData}):"",typeof t.headlineData!="undefined"&&t.dataExist&&t.headlineData.analysed?a(Jn,{data:t.headlineData}):"",a("div",{className:"aioseo-headline-analyzer-bottom-notice",children:a("p",{dangerouslySetInnerHTML:{__html:Qe}})})]})]})};ea("aioseo-headline-analyzer",{icon:m.headline,render:ra});
