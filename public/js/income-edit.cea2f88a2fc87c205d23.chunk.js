(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{"7Uct":function(t,e,o){"use strict";o.r(e);var i=o("P2sY"),n=o.n(i),s=o("EJiy"),a=o.n(s),l=o("QbLZ"),c=o.n(l),r=o("YEIV"),d=o.n(r),m=(o("Snq/"),o("ojEh")),u=o("cqWK"),v=o("j+oE"),h=o("gSaM"),f=o("VFPB"),w=o("eMga"),p=o("L2JU"),b=(o("M74m"),{props:["docId"],data:function(){var t;return t={menu:!1,toggle_multiple:[0,1],selected:[],countRows:0,currentRow:0,editRow:{index:null,item:null,sum:0,comment:""},headers:[{text:"Category",align:"left",sortable:!0,value:"item"},{text:"Amount",value:"sum",align:"left"},{text:"Comment",value:"comment",align:"left",class:"hidden-sm-and-down"}]},d()(t,"menu",!1),d()(t,"modal",!1),d()(t,"active",null),d()(t,"dialog",!1),d()(t,"showWalletSelection",!1),d()(t,"processing",!1),t},components:{VAlert:h.a,VDataTable:v.a,"tm-editRow":f.a,"tm-select":u.a,"v-date-control":m.a},computed:c()({wallet:{get:function(){return this.$store.state.incomes.incomeObj.wallet},set:function(t){this.$store.commit("incomeUpdateWallet",t)}}},Object(p.c)({id:function(t){return t.incomes.incomeObj.id},date:function(t){return t.incomes.incomeObj.date},currency:function(t){return t.incomes.incomeObj.currency},rows:function(t){return t.incomes.incomeObj.rows},closeForm:function(t){return t.incomes.closeForm}}),Object(p.b)({wallets:"allWallets",items:"allIncomeItems"}),{totalAmount:function(){var t=this.rows.reduce(function(t,e){return t+Number(e.sum)},0);return w.a.round2(t)}}),beforeMount:function(){this.$store.state.title="Income",this.$store.commit("setupToolbarMenu",[]),this.$store.commit("setupToolbarMenu",this.getUpMenu()),this.$store.dispatch("getSettings"),this.$store.dispatch("getAllWallets"),this.$store.dispatch("getAllIncomeItems"),this.$store.dispatch("getIncome",this.docId)},watch:{closeForm:function(t,e){!0===t&&this.$router.push({path:"/expends"})}},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"Save",icon:"done",action:function(){t.save()}},menu:[{title:"Cancel",icon:"exit_to_app",action:function(){t.cancel()}}]}},startWalletChoice:function(){this.showWalletSelection=!0},completeWalletSelectionHandler:function(t){void 0!==t&&"object"===(void 0===t?"undefined":a()(t))&&this.walletOnChange(t),this.showWalletSelection=!1},deleteSelected:function(){this.$store.commit("deleteSelected",this.selected)},toggleAll:function(){this.selected.length?this.selected=[]:this.selected=this.rows.slice()},dateOnChange:function(t){this.$store.commit("incomeUpdateDate",t)},walletOnChange:function(t){this.$store.commit("incomeUpdateWallet",t)},editCurrentRow:function(t){this.editRow=n()({},t),this.editRow.index=this.rows.indexOf(t),this.dialog=!0},addNewLine:function(){this.tempRow=null,this.editRow={index:null,item:null,sum:0,comment:""},this.dialog=!0},closeEditRowDialog:function(){this.dialog=!1},saveRow:function(t){if(this.dialog=!1,t.item){if(null===t.index){var e=this.maxRowId();t.rowId=++e}this.$store.commit("incomeEditRow",t),this.editRow={index:null,item:null,sum:0,comment:""}}},maxRowId:function(){if(0==this.rows.length)return 0;var t=this.rows.reduce(function(t,e){return Math.max(t,e.rowId)},0);return t},deleteRow:function(t){this.$store.commit("incomeDeleteRow",t)},openFormItems:function(){this.dialog=!0},chooseItem:function(t){this.editRow.item=t,this.dialog=!1},save:function(){var t=this;this.processing=!0,this.$store.dispatch("saveIncome").then(function(){t.processing=!1,t.$router.push({path:"/incomes"})}).catch(function(e){t.processing=!1})},cancel:function(){this.$router.push({path:"/incomes"})}}}),g=(o("aBKJ"),o("KHd+")),_=o("ZUTo"),x=o.n(_),C=o("B5h7"),R=o("gzZi"),k=o("rHzn"),y=o("Ey0z"),$=o("jjY0"),V=o("mRA0"),A=o("cdmR"),I=o("Kn9U"),S=Object(g.a)(b,function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"row",attrs:{id:"income-form-root"}},[o("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:1==this.processing,expression:"this.processing == true"}],attrs:{indeterminate:!0}}),t._v(" "),o("form",{staticStyle:{"min-width":"100%"}},[o("div",{staticClass:"edit_from_header"},[o("div",{staticClass:"row"},[o("div",{staticClass:"col-xs-12 col-sm-6"},[o("div",{staticClass:"form-group"},[o("label",{staticClass:"tm-input-label",attrs:{for:"expense_date_el"}},[t._v("Date")]),t._v(" "),o("v-date-control",{attrs:{date:t.date},on:{change:t.dateOnChange}})],1)])]),t._v(" "),o("div",{staticClass:"row d-flex"},[o("div",{staticClass:"col-xs-12 col-sm-6"},[o("div",{staticClass:"d-flex flex-wrap"},[o("div",{staticClass:"form-group"},[o("label",{staticClass:"tm-lable",attrs:{for:"wallet_sel"}},[t._v("Wallet:")]),t._v(" "),o("tm-select",{attrs:{id:"wallet_sel",options:t.wallets,title:"name",clearable:!0,"select-btn":!0,placeholder:"Select wallet"},on:{open:t.startWalletChoice},model:{value:t.wallet,callback:function(e){t.wallet=e},expression:"wallet"}})],1)])])]),t._v(" "),o("tm-wallets-select-form",{attrs:{items:this.wallets,showWalletSelection:this.showWalletSelection},on:{"select-wallets-close":t.completeWalletSelectionHandler}})],1),t._v(" "),o("div",{staticClass:"row"},[o("div",{staticClass:"col-12"},[o("tm-editRow",{attrs:{items:t.items,editRow:t.editRow,dialog:t.dialog},on:{close:t.closeEditRowDialog,done:t.saveRow}}),t._v(" "),o("div",{staticClass:"from-table-wrapper"},[o("v-toolbar",{attrs:{color:"appColor",dense:"",dark:""}},[o("v-toolbar-items",[o("v-btn",{attrs:{flat:"",dark:""},on:{click:function(e){return t.addNewLine()}}},[o("v-icon",{attrs:{left:"",dark:""}},[t._v("add")]),t._v("\n                                Add\n                            ")],1),t._v(" "),o("v-btn",{directives:[{name:"show",rawName:"v-show",value:this.selected.length>0,expression:"this.selected.length > 0"}],attrs:{flat:"",dark:""},on:{click:function(e){return t.deleteSelected()}}},[o("v-icon",[t._v("delete")]),t._v("\n                                Delete\n                            ")],1)],1),t._v(" "),o("v-spacer"),t._v(" "),o("v-toolbar-title",{attrs:{color:"white"}},[t._v("Total: "+t._s(t.totalAmount)+" ("+t._s(t.currency.short_name)+")\n                        ")])],1),t._v(" "),o("v-data-table",{staticClass:"elevation-1",attrs:{"select-all":"",headers:t.headers,items:t.rows,"item-key":"rowId",id:"table-of-expenses"},scopedSlots:t._u([{key:"headers",fn:function(e){return[o("th",[o("v-checkbox",{attrs:{"input-value":e.all,indeterminate:e.indeterminate,primary:"","hide-details":""},on:{click:t.toggleAll}})],1),t._v(" "),t._l(e.headers,function(e){return o("th",{key:e.text,class:e.class,attrs:{align:e.align}},[t._v("\n                                "+t._s(e.text)+"\n                            ")])})]}},{key:"items",fn:function(e){return[o("tr",[o("td",{staticClass:"d-none"},[t._v(t._s(e.item.item))]),t._v(" "),o("td",[o("v-checkbox",{attrs:{primary:"","hide-details":""},model:{value:e.selected,callback:function(o){t.$set(e,"selected",o)},expression:"props.selected"}})],1),t._v(" "),o("td",{staticClass:"text-xs-left",on:{click:function(o){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.item.name)+"\n                                ")]),t._v(" "),o("td",{staticClass:"text-xs-left",on:{click:function(o){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.sum)+"\n                                ")]),t._v(" "),o("td",{staticClass:"text-xs-left hidden-sm-and-down",on:{click:function(o){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.comment)+"\n                                ")])])]}}]),model:{value:t.selected,callback:function(e){t.selected=e},expression:"selected"}},[t._v(" "),t._v(" "),o("template",{slot:"no-data"},[o("v-alert",{attrs:{value:!0,type:"info",icon:"warning"}},[t._v('To add a new income, click "Add"\n                            ')])],1)],2)],1)],1)])])],1)},[],!1,null,"4bef9d28",null);e.default=S.exports;x()(S,{VAlert:C.a,VBtn:R.a,VCheckbox:k.a,VDataTable:v.a,VIcon:y.a,VProgressLinear:$.a,VSpacer:V.a,VToolbar:A.a,VToolbarItems:I.a,VToolbarTitle:I.b})},AetC:function(t,e,o){"use strict";var i=o("yC2R");o.n(i).a},M74m:function(t,e,o){},VFPB:function(t,e,o){"use strict";var i=o("eMga"),n={name:"AddRowFrom",props:{dialog:{type:Boolean,default:!1},editRow:{type:Object},items:{type:Array,default:[]}},data:function(){return{fullscreen:!1}},computed:{amount:{get:function(){return this.editRow.sum},set:function(t){this.editRow.sum=i.a.round2(Number(t))}}},methods:{close:function(){this.$emit("close")},saveRow:function(){this.$emit("done",this.editRow)}}},s=(o("AetC"),o("KHd+")),a=o("ZUTo"),l=o.n(a),c=o("xqZp"),r=o("gzZi"),d=o("sK+t"),m=o("mdmw"),u=o("FpqX"),v=o("mRA0"),h=o("Jnd4"),f=o("qEQh"),w=o("cdmR"),p=Object(s.a)(n,function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("v-dialog",{staticClass:"form-dialog-bottom form-dialog",attrs:{"max-width":"550px",persistent:"",fullscreen:t.$vuetify.breakpoint.smAndDown},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[o("v-toolbar",{staticClass:"form-dialog-top",attrs:{dense:"",color:"appColor",dark:""}},[o("v-btn",{attrs:{flat:""},on:{click:t.close}},[t._v("Close")]),t._v(" "),o("v-spacer"),t._v(" "),o("v-btn",{attrs:{flat:""},on:{click:function(e){return t.saveRow(t.editRow)}}},[t._v("Ok")])],1),t._v(" "),o("v-card",{staticClass:"form-dialog-bottom"},[o("v-card-text",[o("div",{staticClass:"row"},[o("div",{staticClass:"col-xs-12 col-sm-6"},[o("v-autocomplete",{attrs:{label:"Item",items:t.items,autocomplete:"true","cache-items":"",clearable:"",outline:"","single-line":"","item-text":"name","item-value":"id","return-object":""},model:{value:t.editRow.item,callback:function(e){t.$set(t.editRow,"item",e)},expression:"editRow.item"}})],1),t._v(" "),o("div",{staticClass:"col-xs-12 col-sm-6"},[o("v-text-field",{attrs:{outline:"",type:"number",clearable:"",label:"Amount"},model:{value:t.amount,callback:function(e){t.amount=t._n(e)},expression:"amount"}})],1)]),t._v(" "),o("div",{staticClass:"row"},[o("div",{staticClass:"col-12"},[o("v-textarea",{attrs:{outline:"",label:"Comment"},model:{value:t.editRow.comment,callback:function(e){t.$set(t.editRow,"comment",e)},expression:"editRow.comment"}})],1)])])],1)],1)},[],!1,null,"6143b660",null);e.a=p.exports;l()(p,{VAutocomplete:c.a,VBtn:r.a,VCard:d.a,VCardText:m.b,VDialog:u.a,VSpacer:v.a,VTextField:h.a,VTextarea:f.a,VToolbar:w.a})},aBKJ:function(t,e,o){"use strict";var i=o("nkyy");o.n(i).a},nkyy:function(t,e,o){},yC2R:function(t,e,o){}}]);