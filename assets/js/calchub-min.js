/*! ========= INFORMATION ============================
	- author:    CalcHub
	- url:       https://calchub.xyz
	- plugin:    https://wordpress.org/plugins/calculator-builder/
==================================================== */
"use strict";const CalculatorBuilder=function(){function t(t){let e=[];const o=t.querySelectorAll("fieldset");for(let t=0;t<o.length;t++){e[t+1]=o[t]}return e}function e(t){let e=[];const o=t.querySelectorAll(".formbox__title");for(let t=0;t<o.length;t++){e[t+1]=o[t]}return e}function o(t){const e=t.querySelectorAll('[name^="formbox-field-"], button');let o=[];for(let t=0;t<e.length;t++){o[t+1]=e[t]}return o}function r(t,e){let o=[];const r=t.querySelectorAll('[name^="formbox-field-"]');for(let t of e.entries()){o[t[0].split("-")[2]]=parseFloat(t[1])}for(let t=0;t<r.length;t++){if("textarea"===r[t].tagName.toLowerCase()){o[r[t].getAttribute("name").split("-")[2]]=r[t].value}if("input"===r[t].tagName.toLowerCase()&&"number"!==r[t].getAttribute("type")&&"radio"!==r[t].getAttribute("type")){o[r[t].getAttribute("name").split("-")[2]]=r[t].value}if("input"===r[t].tagName.toLowerCase()&&"checkbox"===r[t].getAttribute("type")){let e=r[t].getAttribute("name").split("-");r[t].checked?o[e[2]]=parseFloat(r[t].value):o[e[2]]=0}}return o}function n(t){s(this.form,"add")}function i(n){n.preventDefault();const i=e(this.form),l=t(this.form),a=o(this.form),f=new FormData(this.form);let d=r(this.form,f),u=window[this.form.id](d,l,a,i);const c=this.form.querySelectorAll('[name^="formbox-field-"]');for(let t=0;t<c.length;t++)if(c[t].hasAttribute("required")&&""===c[t].value)return c[t].focus({preventScroll:!1}),!1;const m=this.form.querySelectorAll(".formbox__field-result");for(let t=1;t<u.length;t++){let e=m[t-1];"input"!==e.tagName.toLowerCase()&&"textarea"!==e.tagName.toLowerCase()||(e.value=u[t]),"textarea"===e.tagName.toLowerCase()&&e.hasAttribute("hidden")&&(e.nextElementSibling.innerHTML=u[t]),s(this.form,"remove")}}function l(n){n.preventDefault();const i=e(this.form),l=t(this.form),a=o(this.form),s=new FormData(this.form);let f=r(this.form,s);window[this.form.id](f,l,a,i)}function a(){s(this.form,"add");const n=e(this.form),i=t(this.form),l=o(this.form);let a=r(this.form,this.data);window[this.form.id](a,i,l,n)}function s(t,e){let o=t.querySelectorAll(".formbox__container.has-result");o&&o.forEach((t=>{"remove"===e?t.classList.remove("is-hidden"):t.classList.add("is-hidden")}))}document.querySelectorAll(".formbox").forEach((t=>{let e=t.querySelector(".formbox__btn-calc");e&&e.addEventListener("click",{handleEvent:i,form:t});const o=new FormData(t);t.addEventListener("reset",{handleEvent:a,form:t,data:o}),t.querySelector(".calc-reset")?t.addEventListener("change",{handleEvent:n,form:t}):t.addEventListener("change",{handleEvent:i,form:t}),t.querySelector(".calc-load")&&window.addEventListener("load",{handleEvent:i,form:t}),window.addEventListener("load",{handleEvent:l,form:t})})),Element.prototype.hide=function(){this.classList.add("is-hidden")},Element.prototype.show=function(){this.classList.remove("is-hidden")},Element.prototype.addClass=function(t){this.classList.add(t)},Element.prototype.removeClass=function(t){this.classList.remove(t)},Element.prototype.addAttr=function(t,e){t=t||"",e=e||"",this.setAttribute(t,e)},Element.prototype.removeAttr=function(t){t=t||"",this.removeAttribute(t)},Element.prototype.text=function(t){t=t||"",this.innerText=t},Number.prototype.round=function(t="2"){const e=Math.pow(10,parseInt(t));return Math.round(this*e)/e}};document.addEventListener("DOMContentLoaded",(function(){new CalculatorBuilder}));const roundVal=(t,e="2")=>{const o=Math.pow(10,parseInt(e));return Math.round(t*o)/o};