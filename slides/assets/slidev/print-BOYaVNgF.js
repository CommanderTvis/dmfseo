import{d as _,B as u,a as n,b as t,t as s,u as c,F as h,C as f,e as v,o as l,j as g,p as x,D as b}from"../modules/vue-B2D8rSnt.js";import{j as y,u as N,n as m}from"../index-C-bEV0NO.js";import{_ as k}from"./NoteDisplay.vue_vue_type_style_index_0_lang-BNxzV07f.js";import"../modules/shiki-ELPwyEH1.js";const w={id:"page-root"},B={class:"m-4"},L={class:"mb-10"},T={class:"text-4xl font-bold mt-2"},V={class:"opacity-50"},j={class:"text-lg"},C={class:"font-bold flex gap-2"},D={class:"opacity-50"},H={key:0,class:"border-main mb-8"},A=_({__name:"print",setup(S){const{slides:d,total:p}=y();u(`
@page {
  size: A4;
  margin-top: 1.5cm;
  margin-bottom: 1cm;
}
* {
  -webkit-print-color-adjust: exact;
}
html,
html body,
html #app,
html #page-root {
  height: auto;
  overflow: auto !important;
}
`),N({title:`Notes - ${m.title}`});const i=v(()=>d.value.map(o=>{var a;return(a=o.meta)==null?void 0:a.slide}).filter(o=>o!==void 0&&o.noteHTML!==""));return(o,a)=>(l(),n("div",w,[t("div",B,[t("div",L,[t("h1",T,s(c(m).title),1),t("div",V,s(new Date().toLocaleString()),1)]),(l(!0),n(h,null,f(i.value,(e,r)=>(l(),n("div",{key:r,class:"flex flex-col gap-4 break-inside-avoid-page"},[t("div",null,[t("h2",j,[t("div",C,[t("div",D,s(e==null?void 0:e.no)+"/"+s(c(p)),1),g(" "+s(e==null?void 0:e.title)+" ",1),a[0]||(a[0]=t("div",{class:"flex-auto"},null,-1))])]),x(k,{"note-html":e.noteHTML,class:"max-w-full"},null,8,["note-html"])]),r<i.value.length-1?(l(),n("hr",H)):b("v-if",!0)]))),128))])]))}});export{A as default};
