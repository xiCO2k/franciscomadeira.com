import{u as ce,r as oe,o as B,c as M,a as N,w as z,n as J,b as A,d as ie,t as fe,e as pe,f as de,F as he,g as K,h as me,s as ge,I as ye,i as ve,j as be,k as _e,L as we,H as Oe,l as je}from"./vendor.433855f7.js";const xe="modulepreload",X={},ke="/build/",I=function(r,e){return!e||e.length===0?r():Promise.all(e.map(n=>{if(n=`${ke}${n}`,n in X)return;X[n]=!0;const c=n.endsWith(".css"),o=c?'[rel="stylesheet"]':"";if(document.querySelector(`link[href="${n}"]${o}`))return;const i=document.createElement("link");if(i.rel=c?"stylesheet":xe,c||(i.as="script",i.crossOrigin=""),i.href=n,document.head.appendChild(i),c)return new Promise((s,a)=>{i.addEventListener("load",s),i.addEventListener("error",a)})})).then(()=>r())};var Pe="/build/assets/square.a8c8ad4a.webp",Se="/build/assets/square.a9e01c78.jpg";const Ee={class:"flex space-x-4 sm:space-x-8 text-gray-400 text-sm sm:text-base"},Ae=A("span",{class:"hidden sm:inline"},"Given",-1),$e=ie(" Talks "),De=ie(" About "),Le=A("a",{href:"https://github.com/xico2k",target:"_blank",rel:"noreferrer",class:"link-underline hover:text-gray-100"}," GitHub ",-1),Re=A("a",{href:"https://twitter.com/xico2k",target:"_blank",rel:"noreferrer",class:"link-underline hover:text-gray-100"}," Twitter ",-1),Te={setup(t){const r=ce(),e=(...n)=>{let c=r.url.value.substr(1);return n[0]===""?c==="":n.filter(o=>c.startsWith(o)).length};return(n,c)=>{const o=oe("Link");return B(),M("nav",Ee,[N(o,{href:"/given-talks",class:J(["link-underline hover:text-gray-100",e("given-talks")?"active text-gray-100":""])},{default:z(()=>[Ae,$e]),_:1},8,["class"]),N(o,{href:"/about",class:J(["link-underline hover:text-gray-100",e("about")?"active text-gray-100":""])},{default:z(()=>[De]),_:1},8,["class"]),Le,Re])}}},Ce=Pe,Ne={class:"pt-6 sm:pt-8 px-6 sm:px-8 flex flex-col sm:flex-row w-full max-w-7xl items-center sm:justify-between mb-4 sm:mb-8"},Fe=A("picture",null,[A("source",{type:"image/webp",srcset:Ce}),A("img",{src:Se,class:"w-14 h-14 sm:w-20 sm:h-20 border-4 sm:border-4 border-gray-800 rounded-full",width:"80",height:"80",alt:"Francisco Madeira"})],-1),He=A("div",{class:"hidden md:block ml-4 font-bold text-lg"}," Francisco Madeira ",-1),Ie={setup(t){return(r,e)=>{const n=oe("Link");return B(),M("header",Ne,[N(n,{href:r.route("home"),class:"flex mb-4 sm:mb-0 items-center text-gray-400 hover:text-white"},{default:z(()=>[Fe,He]),_:1},8,["href"]),N(Te)])}}},Ve={class:"px-8 my-12 w-full max-w-7xl text-xs text-white text-opacity-50 text-center"},Be={setup(t){const r=new Date().getFullYear();return(e,n)=>(B(),M("footer",Ve," \xA9 "+fe(pe(r))+". No tracking or ads. ",1))}},Me={class:"flex-1"},Qe={class:"w-screen"},qe={setup(t){return(r,e)=>(B(),M(he,null,[N(Ie),A("div",Me,[A("div",Qe,[de(r.$slots,"default")])]),N(Be)],64))}},Ue=typeof window=="undefined";ge("/shiki/");const ze=()=>{const t="github-dark",r=K(!1),e=K(!1);let n;return{install:async()=>{if(n||e.value)return;e.value=!0;const i=["html","php",{id:"blade",scopeName:"text.html.php.blade",path:(Ue?"../../public/shiki/":"")+"languages/blade.tmLanguage.json",embeddedLangs:["html","php"]}];return n=await me({theme:t,langs:i}),r.value=!0,e.value=!1,n},getLines:(i,s)=>n?n.codeToThemedTokens(i,s,t):i.split(/\n/g).map(a=>[{color:"",content:a}]),loaded:r}},Ze={install:(t,r=!1)=>{const e=ze();t.provide("highlighter",e),r&&e.install()}};function ee(t,r){for(var e=0;e<r.length;e++){var n=r[e];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function ae(t,r,e){return r&&ee(t.prototype,r),e&&ee(t,e),Object.defineProperty(t,"prototype",{writable:!1}),t}function P(){return P=Object.assign||function(t){for(var r=1;r<arguments.length;r++){var e=arguments[r];for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n])}return t},P.apply(this,arguments)}function Z(t){return Z=Object.setPrototypeOf?Object.getPrototypeOf:function(r){return r.__proto__||Object.getPrototypeOf(r)},Z(t)}function H(t,r){return H=Object.setPrototypeOf||function(e,n){return e.__proto__=n,e},H(t,r)}function Ge(){if(typeof Reflect=="undefined"||!Reflect.construct||Reflect.construct.sham)return!1;if(typeof Proxy=="function")return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],function(){})),!0}catch{return!1}}function G(t,r,e){return G=Ge()?Reflect.construct:function(n,c,o){var i=[null];i.push.apply(i,c);var s=new(Function.bind.apply(n,i));return o&&H(s,o.prototype),s},G.apply(null,arguments)}function W(t){var r=typeof Map=="function"?new Map:void 0;return W=function(e){if(e===null||Function.toString.call(e).indexOf("[native code]")===-1)return e;if(typeof e!="function")throw new TypeError("Super expression must either be null or a function");if(r!==void 0){if(r.has(e))return r.get(e);r.set(e,n)}function n(){return G(e,arguments,Z(this).constructor)}return n.prototype=Object.create(e.prototype,{constructor:{value:n,enumerable:!1,writable:!0,configurable:!0}}),H(n,e)},W(t)}var We=String.prototype.replace,Ye=/%20/g,C={default:"RFC3986",formatters:{RFC1738:function(t){return We.call(t,Ye,"+")},RFC3986:function(t){return String(t)}},RFC1738:"RFC1738",RFC3986:"RFC3986"},q=Object.prototype.hasOwnProperty,L=Array.isArray,E=function(){for(var t=[],r=0;r<256;++r)t.push("%"+((r<16?"0":"")+r.toString(16)).toUpperCase());return t}(),te=function(t,r){for(var e=r&&r.plainObjects?Object.create(null):{},n=0;n<t.length;++n)t[n]!==void 0&&(e[n]=t[n]);return e},D={arrayToObject:te,assign:function(t,r){return Object.keys(r).reduce(function(e,n){return e[n]=r[n],e},t)},combine:function(t,r){return[].concat(t,r)},compact:function(t){for(var r=[{obj:{o:t},prop:"o"}],e=[],n=0;n<r.length;++n)for(var c=r[n],o=c.obj[c.prop],i=Object.keys(o),s=0;s<i.length;++s){var a=i[s],u=o[a];typeof u=="object"&&u!==null&&e.indexOf(u)===-1&&(r.push({obj:o,prop:a}),e.push(u))}return function(d){for(;d.length>1;){var l=d.pop(),h=l.obj[l.prop];if(L(h)){for(var g=[],p=0;p<h.length;++p)h[p]!==void 0&&g.push(h[p]);l.obj[l.prop]=g}}}(r),t},decode:function(t,r,e){var n=t.replace(/\+/g," ");if(e==="iso-8859-1")return n.replace(/%[0-9a-f]{2}/gi,unescape);try{return decodeURIComponent(n)}catch{return n}},encode:function(t,r,e,n,c){if(t.length===0)return t;var o=t;if(typeof t=="symbol"?o=Symbol.prototype.toString.call(t):typeof t!="string"&&(o=String(t)),e==="iso-8859-1")return escape(o).replace(/%u[0-9a-f]{4}/gi,function(u){return"%26%23"+parseInt(u.slice(2),16)+"%3B"});for(var i="",s=0;s<o.length;++s){var a=o.charCodeAt(s);a===45||a===46||a===95||a===126||a>=48&&a<=57||a>=65&&a<=90||a>=97&&a<=122||c===C.RFC1738&&(a===40||a===41)?i+=o.charAt(s):a<128?i+=E[a]:a<2048?i+=E[192|a>>6]+E[128|63&a]:a<55296||a>=57344?i+=E[224|a>>12]+E[128|a>>6&63]+E[128|63&a]:(a=65536+((1023&a)<<10|1023&o.charCodeAt(s+=1)),i+=E[240|a>>18]+E[128|a>>12&63]+E[128|a>>6&63]+E[128|63&a])}return i},isBuffer:function(t){return!(!t||typeof t!="object"||!(t.constructor&&t.constructor.isBuffer&&t.constructor.isBuffer(t)))},isRegExp:function(t){return Object.prototype.toString.call(t)==="[object RegExp]"},maybeMap:function(t,r){if(L(t)){for(var e=[],n=0;n<t.length;n+=1)e.push(r(t[n]));return e}return r(t)},merge:function t(r,e,n){if(!e)return r;if(typeof e!="object"){if(L(r))r.push(e);else{if(!r||typeof r!="object")return[r,e];(n&&(n.plainObjects||n.allowPrototypes)||!q.call(Object.prototype,e))&&(r[e]=!0)}return r}if(!r||typeof r!="object")return[r].concat(e);var c=r;return L(r)&&!L(e)&&(c=te(r,n)),L(r)&&L(e)?(e.forEach(function(o,i){if(q.call(r,i)){var s=r[i];s&&typeof s=="object"&&o&&typeof o=="object"?r[i]=t(s,o,n):r.push(o)}else r[i]=o}),r):Object.keys(e).reduce(function(o,i){var s=e[i];return o[i]=q.call(o,i)?t(o[i],s,n):s,o},c)}},Je=Object.prototype.hasOwnProperty,re={brackets:function(t){return t+"[]"},comma:"comma",indices:function(t,r){return t+"["+r+"]"},repeat:function(t){return t}},R=Array.isArray,Ke=String.prototype.split,Xe=Array.prototype.push,se=function(t,r){Xe.apply(t,R(r)?r:[r])},et=Date.prototype.toISOString,ne=C.default,w={addQueryPrefix:!1,allowDots:!1,charset:"utf-8",charsetSentinel:!1,delimiter:"&",encode:!0,encoder:D.encode,encodeValuesOnly:!1,format:ne,formatter:C.formatters[ne],indices:!1,serializeDate:function(t){return et.call(t)},skipNulls:!1,strictNullHandling:!1},tt=function t(r,e,n,c,o,i,s,a,u,d,l,h,g,p){var y,m=r;if(typeof s=="function"?m=s(e,m):m instanceof Date?m=d(m):n==="comma"&&R(m)&&(m=D.maybeMap(m,function(T){return T instanceof Date?d(T):T})),m===null){if(c)return i&&!g?i(e,w.encoder,p,"key",l):e;m=""}if(typeof(y=m)=="string"||typeof y=="number"||typeof y=="boolean"||typeof y=="symbol"||typeof y=="bigint"||D.isBuffer(m)){if(i){var _=g?e:i(e,w.encoder,p,"key",l);if(n==="comma"&&g){for(var f=Ke.call(String(m),","),v="",b=0;b<f.length;++b)v+=(b===0?"":",")+h(i(f[b],w.encoder,p,"value",l));return[h(_)+"="+v]}return[h(_)+"="+h(i(m,w.encoder,p,"value",l))]}return[h(e)+"="+h(String(m))]}var k,O=[];if(m===void 0)return O;if(n==="comma"&&R(m))k=[{value:m.length>0?m.join(",")||null:void 0}];else if(R(s))k=s;else{var F=Object.keys(m);k=a?F.sort(a):F}for(var S=0;S<k.length;++S){var x=k[S],j=typeof x=="object"&&x.value!==void 0?x.value:m[x];if(!o||j!==null){var $=R(m)?typeof n=="function"?n(e,x):e:e+(u?"."+x:"["+x+"]");se(O,t(j,$,n,c,o,i,s,a,u,d,l,h,g,p))}}return O},Y=Object.prototype.hasOwnProperty,rt=Array.isArray,V={allowDots:!1,allowPrototypes:!1,arrayLimit:20,charset:"utf-8",charsetSentinel:!1,comma:!1,decoder:D.decode,delimiter:"&",depth:5,ignoreQueryPrefix:!1,interpretNumericEntities:!1,parameterLimit:1e3,parseArrays:!0,plainObjects:!1,strictNullHandling:!1},nt=function(t){return t.replace(/&#(\d+);/g,function(r,e){return String.fromCharCode(parseInt(e,10))})},le=function(t,r){return t&&typeof t=="string"&&r.comma&&t.indexOf(",")>-1?t.split(","):t},ot=function(t,r,e,n){if(t){var c=e.allowDots?t.replace(/\.([^.[]+)/g,"[$1]"):t,o=/(\[[^[\]]*])/g,i=e.depth>0&&/(\[[^[\]]*])/.exec(c),s=i?c.slice(0,i.index):c,a=[];if(s){if(!e.plainObjects&&Y.call(Object.prototype,s)&&!e.allowPrototypes)return;a.push(s)}for(var u=0;e.depth>0&&(i=o.exec(c))!==null&&u<e.depth;){if(u+=1,!e.plainObjects&&Y.call(Object.prototype,i[1].slice(1,-1))&&!e.allowPrototypes)return;a.push(i[1])}return i&&a.push("["+c.slice(i.index)+"]"),function(d,l,h,g){for(var p=g?l:le(l,h),y=d.length-1;y>=0;--y){var m,_=d[y];if(_==="[]"&&h.parseArrays)m=[].concat(p);else{m=h.plainObjects?Object.create(null):{};var f=_.charAt(0)==="["&&_.charAt(_.length-1)==="]"?_.slice(1,-1):_,v=parseInt(f,10);h.parseArrays||f!==""?!isNaN(v)&&_!==f&&String(v)===f&&v>=0&&h.parseArrays&&v<=h.arrayLimit?(m=[])[v]=p:f!=="__proto__"&&(m[f]=p):m={0:p}}p=m}return p}(a,r,e,n)}},U=function(){function t(e,n,c){var o,i;this.name=e,this.definition=n,this.bindings=(o=n.bindings)!=null?o:{},this.wheres=(i=n.wheres)!=null?i:{},this.config=c}var r=t.prototype;return r.matchesUrl=function(e){if(!this.definition.methods.includes("GET"))return!1;var n=this.template.replace(/\/{[^}?]*\?}/g,"(/[^/?]+)?").replace(/{[^}?]*\?}/g,"([^/?]+)?").replace(/{[^}]+}/g,"[^/?]+").replace(/^\w+:\/\//,"");return new RegExp("^"+n+"$").test(e.replace(/\/+$/,"").split("?").shift())},r.compile=function(e){var n=this;return this.parameterSegments.length?this.template.replace(/{([^}?]+)\??}/g,function(c,o){var i,s;if([null,void 0].includes(e[o])&&n.parameterSegments.find(function(a){return a.name===o}).required)throw new Error("Ziggy error: '"+o+"' parameter is required for route '"+n.name+"'.");return n.parameterSegments[n.parameterSegments.length-1].name===o&&n.wheres[o]===".*"?(s=e[o])!=null?s:"":encodeURIComponent((i=e[o])!=null?i:"")}).replace(/\/+$/,""):this.template},ae(t,[{key:"template",get:function(){return((this.config.absolute?this.definition.domain?""+this.config.url.match(/^\w+:\/\//)[0]+this.definition.domain+(this.config.port?":"+this.config.port:""):this.config.url:"")+"/"+this.definition.uri).replace(/\/+$/,"")}},{key:"parameterSegments",get:function(){var e,n;return(e=(n=this.template.match(/{[^}?]+\??}/g))==null?void 0:n.map(function(c){return{name:c.replace(/{|\??}/g,""),required:!/\?}$/.test(c)}}))!=null?e:[]}}]),t}(),it=function(t){var r,e;function n(o,i,s,a){var u;if(s===void 0&&(s=!0),(u=t.call(this)||this).t=a!=null?a:typeof Ziggy!="undefined"?Ziggy:globalThis==null?void 0:globalThis.Ziggy,u.t=P({},u.t,{absolute:s}),o){if(!u.t.routes[o])throw new Error("Ziggy error: route '"+o+"' is not in the route list.");u.i=new U(o,u.t.routes[o],u.t),u.u=u.l(i)}return u}e=t,(r=n).prototype=Object.create(e.prototype),r.prototype.constructor=r,H(r,e);var c=n.prototype;return c.toString=function(){var o=this,i=Object.keys(this.u).filter(function(s){return!o.i.parameterSegments.some(function(a){return a.name===s})}).filter(function(s){return s!=="_query"}).reduce(function(s,a){var u;return P({},s,((u={})[a]=o.u[a],u))},{});return this.i.compile(this.u)+function(s,a){var u,d=s,l=function(f){if(!f)return w;if(f.encoder!=null&&typeof f.encoder!="function")throw new TypeError("Encoder has to be a function.");var v=f.charset||w.charset;if(f.charset!==void 0&&f.charset!=="utf-8"&&f.charset!=="iso-8859-1")throw new TypeError("The charset option must be either utf-8, iso-8859-1, or undefined");var b=C.default;if(f.format!==void 0){if(!Je.call(C.formatters,f.format))throw new TypeError("Unknown format option provided.");b=f.format}var k=C.formatters[b],O=w.filter;return(typeof f.filter=="function"||R(f.filter))&&(O=f.filter),{addQueryPrefix:typeof f.addQueryPrefix=="boolean"?f.addQueryPrefix:w.addQueryPrefix,allowDots:f.allowDots===void 0?w.allowDots:!!f.allowDots,charset:v,charsetSentinel:typeof f.charsetSentinel=="boolean"?f.charsetSentinel:w.charsetSentinel,delimiter:f.delimiter===void 0?w.delimiter:f.delimiter,encode:typeof f.encode=="boolean"?f.encode:w.encode,encoder:typeof f.encoder=="function"?f.encoder:w.encoder,encodeValuesOnly:typeof f.encodeValuesOnly=="boolean"?f.encodeValuesOnly:w.encodeValuesOnly,filter:O,format:b,formatter:k,serializeDate:typeof f.serializeDate=="function"?f.serializeDate:w.serializeDate,skipNulls:typeof f.skipNulls=="boolean"?f.skipNulls:w.skipNulls,sort:typeof f.sort=="function"?f.sort:null,strictNullHandling:typeof f.strictNullHandling=="boolean"?f.strictNullHandling:w.strictNullHandling}}(a);typeof l.filter=="function"?d=(0,l.filter)("",d):R(l.filter)&&(u=l.filter);var h=[];if(typeof d!="object"||d===null)return"";var g=re[a&&a.arrayFormat in re?a.arrayFormat:a&&"indices"in a?a.indices?"indices":"repeat":"indices"];u||(u=Object.keys(d)),l.sort&&u.sort(l.sort);for(var p=0;p<u.length;++p){var y=u[p];l.skipNulls&&d[y]===null||se(h,tt(d[y],y,g,l.strictNullHandling,l.skipNulls,l.encode?l.encoder:null,l.filter,l.sort,l.allowDots,l.serializeDate,l.format,l.formatter,l.encodeValuesOnly,l.charset))}var m=h.join(l.delimiter),_=l.addQueryPrefix===!0?"?":"";return l.charsetSentinel&&(_+=l.charset==="iso-8859-1"?"utf8=%26%2310003%3B&":"utf8=%E2%9C%93&"),m.length>0?_+m:""}(P({},i,this.u._query),{addQueryPrefix:!0,arrayFormat:"indices",encodeValuesOnly:!0,skipNulls:!0,encoder:function(s,a){return typeof s=="boolean"?Number(s):a(s)}})},c.current=function(o,i){var s=this,a=this.t.absolute?this.v().host+this.v().pathname:this.v().pathname.replace(this.t.url.replace(/^\w*:\/\/[^/]+/,""),"").replace(/^\/+/,"/"),u=Object.entries(this.t.routes).find(function(y){return new U(o,y[1],s.t).matchesUrl(a)})||[void 0,void 0],d=u[0],l=u[1];if(!o)return d;var h=new RegExp("^"+o.replace(/\./g,"\\.").replace(/\*/g,".*")+"$").test(d);if([null,void 0].includes(i)||!h)return h;var g=new U(d,l,this.t);i=this.l(i,g);var p=this.p(l);return!(!Object.values(i).every(function(y){return!y})||Object.values(p).length)||Object.entries(i).every(function(y){return p[y[0]]==y[1]})},c.v=function(){var o,i,s,a,u,d,l=typeof window!="undefined"?window.location:{},h=l.host,g=l.pathname,p=l.search;return{host:(o=(i=this.t.location)==null?void 0:i.host)!=null?o:h===void 0?"":h,pathname:(s=(a=this.t.location)==null?void 0:a.pathname)!=null?s:g===void 0?"":g,search:(u=(d=this.t.location)==null?void 0:d.search)!=null?u:p===void 0?"":p}},c.has=function(o){return Object.keys(this.t.routes).includes(o)},c.l=function(o,i){var s=this;o===void 0&&(o={}),i===void 0&&(i=this.i),o=["string","number"].includes(typeof o)?[o]:o;var a=i.parameterSegments.filter(function(d){return!s.t.defaults[d.name]});if(Array.isArray(o))o=o.reduce(function(d,l,h){var g,p;return P({},d,a[h]?((g={})[a[h].name]=l,g):((p={})[l]="",p))},{});else if(a.length===1&&!o[a[0].name]&&(o.hasOwnProperty(Object.values(i.bindings)[0])||o.hasOwnProperty("id"))){var u;(u={})[a[0].name]=o,o=u}return P({},this.h(i),this.g(o,i))},c.h=function(o){var i=this;return o.parameterSegments.filter(function(s){return i.t.defaults[s.name]}).reduce(function(s,a,u){var d,l=a.name;return P({},s,((d={})[l]=i.t.defaults[l],d))},{})},c.g=function(o,i){var s=i.bindings,a=i.parameterSegments;return Object.entries(o).reduce(function(u,d){var l,h,g=d[0],p=d[1];if(!p||typeof p!="object"||Array.isArray(p)||!a.some(function(y){return y.name===g}))return P({},u,((h={})[g]=p,h));if(!p.hasOwnProperty(s[g])){if(!p.hasOwnProperty("id"))throw new Error("Ziggy error: object passed as '"+g+"' parameter is missing route model binding key '"+s[g]+"'.");s[g]="id"}return P({},u,((l={})[g]=p[s[g]],l))},{})},c.p=function(o){var i,s=this.v().pathname.replace(this.t.url.replace(/^\w*:\/\/[^/]+/,""),"").replace(/^\/+/,""),a=function(u,d,l){d===void 0&&(d="");var h=[u,d].map(function(p){return p.split(l)}),g=h[0];return h[1].reduce(function(p,y,m){var _;return/{[^}?]+\??}/.test(y)&&g[m]?P({},p,((_={})[y.replace(/.*{|\??}.*/g,"")]=g[m].replace(y.match(/^[^{]*/g),"").replace(y.match(/[^}]*$/g),""),_)):p},{})};return P({},a(this.v().host,o.domain,"."),a(s,o.uri,"/"),function(u,d){var l=V;if(u===""||u==null)return l.plainObjects?Object.create(null):{};for(var h=typeof u=="string"?function(f,v){var b,k={},O=(v.ignoreQueryPrefix?f.replace(/^\?/,""):f).split(v.delimiter,v.parameterLimit===1/0?void 0:v.parameterLimit),F=-1,S=v.charset;if(v.charsetSentinel)for(b=0;b<O.length;++b)O[b].indexOf("utf8=")===0&&(O[b]==="utf8=%E2%9C%93"?S="utf-8":O[b]==="utf8=%26%2310003%3B"&&(S="iso-8859-1"),F=b,b=O.length);for(b=0;b<O.length;++b)if(b!==F){var x,j,$=O[b],T=$.indexOf("]="),Q=T===-1?$.indexOf("="):T+1;Q===-1?(x=v.decoder($,V.decoder,S,"key"),j=v.strictNullHandling?null:""):(x=v.decoder($.slice(0,Q),V.decoder,S,"key"),j=D.maybeMap(le($.slice(Q+1),v),function(ue){return v.decoder(ue,V.decoder,S,"value")})),j&&v.interpretNumericEntities&&S==="iso-8859-1"&&(j=nt(j)),$.indexOf("[]=")>-1&&(j=rt(j)?[j]:j),k[x]=Y.call(k,x)?D.combine(k[x],j):j}return k}(u,l):u,g=l.plainObjects?Object.create(null):{},p=Object.keys(h),y=0;y<p.length;++y){var m=p[y],_=ot(m,h[m],l,typeof u=="string");g=D.merge(g,_,l)}return D.compact(g)}((i=this.v().search)==null?void 0:i.replace(/^\?/,"")))},c.valueOf=function(){return this.toString()},c.check=function(o){return this.has(o)},ae(n,[{key:"params",get:function(){return this.p(this.t.routes[this.current()])}}]),n}(W(String)),at={install:function(t,r){return t.mixin({methods:{route:function(e,n,c,o){return o===void 0&&(o=r),function(i,s,a,u){var d=new it(i,s,a,u);return i?d.toString():d}(e,n,c,o)}}})}};ye.init();ve({resolve:async t=>{var n;const r={"./Pages/Error.vue":()=>I(()=>import("./Error.b9db8a04.js"),["assets/Error.b9db8a04.js","assets/vendor.433855f7.js"]),"./Pages/GivenTalks.vue":()=>I(()=>import("./GivenTalks.d85497ec.js"),["assets/GivenTalks.d85497ec.js","assets/Markdown.d4b56121.js","assets/vendor.433855f7.js"]),"./Pages/Home.vue":()=>I(()=>import("./Home.5fb1662e.js"),["assets/Home.5fb1662e.js","assets/vendor.433855f7.js"]),"./Pages/Post.vue":()=>I(()=>import("./Post.6edb6a03.js"),["assets/Post.6edb6a03.js","assets/Markdown.d4b56121.js","assets/vendor.433855f7.js"])},{default:e}=await r[`./Pages/${t}.vue`]();return e.layout===void 0&&(e.layout=qe),((n=e.props)==null?void 0:n.layout)===null&&(e.layout=void 0),e},title:t=>{const r="Francisco Madeira";return!t||t===r?r:`${t} - ${r}`},setup({el:t,App:r,props:e,plugin:n}){be({render:()=>_e(r,e)}).use(n).use(Ze).use(at).component("Link",we).component("Head",Oe).directive("emoji",{mounted(c){c.innerHTML=je.parse(c.innerHTML)}}).mount(t)}});export{Te as _,Se as a,Pe as b};
