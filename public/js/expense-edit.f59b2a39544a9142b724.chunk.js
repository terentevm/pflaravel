(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{C2lQ:function(t,e,a){},IxiZ:function(t,e,a){},M74m:function(t,e,a){},VFPB:function(t,e,a){"use strict";var s=a("eMga"),n={name:"AddRowFrom",props:{dialog:{type:Boolean,default:!1},editRow:{type:Object},items:{type:Array,default:[]}},data:function(){return{fullscreen:!1}},computed:{amount:{get:function(){return this.editRow.sum},set:function(t){this.editRow.sum=s.a.round2(Number(t))}}},methods:{close:function(){this.$emit("close")},saveRow:function(){this.$emit("done",this.editRow)}}},o=(a("hLq4"),a("KHd+")),i=a("ZUTo"),l=a.n(i),c=a("xqZp"),r=a("gzZi"),d=a("sK+t"),u=a("mdmw"),m=a("pSOK"),p=a("FpqX"),v=a("Do8S"),h=a("pyJu"),f=a("mRA0"),w=a("Jnd4"),x=a("qEQh"),b=a("cdmR"),g=Object(o.a)(n,function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-layout",{attrs:{row:"","justify-center":""}},[a("v-dialog",{staticClass:"form-dialog-bottom form-dialog",attrs:{"max-width":"550px",persistent:"",fullscreen:t.$vuetify.breakpoint.smAndDown},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-toolbar",{staticClass:"form-dialog-top",attrs:{dense:"",color:"appColor",dark:""}},[a("v-btn",{attrs:{flat:""},on:{click:t.close}},[t._v("Close")]),t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{flat:""},on:{click:function(e){return t.saveRow(t.editRow)}}},[t._v("Ok")])],1),t._v(" "),a("v-card",{staticClass:"form-dialog-bottom"},[a("v-card-text",[a("v-container",{attrs:{"grid-list-md":""}},[a("v-layout",{attrs:{row:""}},[a("v-flex",{attrs:{xs12:"",sm6:"",md6:"",lg6:""}},[a("v-autocomplete",{attrs:{label:"Item",items:t.items,autocomplete:"true","cache-items":"",clearable:"",outline:"","single-line":"","item-text":"name","item-value":"id","return-object":""},model:{value:t.editRow.item,callback:function(e){t.$set(t.editRow,"item",e)},expression:"editRow.item"}})],1),t._v(" "),a("v-flex",{attrs:{xs12:"",sm6:"",md6:"",lg6:""}},[a("v-text-field",{attrs:{outline:"",type:"number",clearable:"",label:"Amount"},model:{value:t.amount,callback:function(e){t.amount=t._n(e)},expression:"amount"}})],1),t._v(" "),a("v-flex",{attrs:{xs12:"",sm12:"",md12:"",lg12:""}},[a("v-textarea",{attrs:{outline:"",label:"Comment"},model:{value:t.editRow.comment,callback:function(e){t.$set(t.editRow,"comment",e)},expression:"editRow.comment"}})],1)],1)],1)],1)],1)],1)],1)},[],!1,null,"221b8fbd",null);e.a=g.exports;l()(g,{VAutocomplete:c.a,VBtn:r.a,VCard:d.a,VCardText:u.b,VContainer:m.a,VDialog:p.a,VFlex:v.a,VLayout:h.a,VSpacer:f.a,VTextField:w.a,VTextarea:x.a,VToolbar:b.a})},gwF3:function(t,e,a){"use strict";var s=a("C2lQ");a.n(s).a},hLq4:function(t,e,a){"use strict";var s=a("rotN");a.n(s).a},iAfy:function(t,e,a){"use strict";a.r(e);var s=a("P2sY"),n=a.n(s),o=a("EJiy"),i=a.n(o),l=a("QbLZ"),c=a.n(l),r=a("Snq/"),d=a.n(r),u=a("Lku0"),m=a("Mm0z"),p=a("wd/R"),v=a.n(p),h={name:"TMDateControl",props:{date:{type:String,required:!0},label:{type:String,default:"Date"}},data:function(){return{dateSelection:!1}},components:{VMenu:m.a,"v-date-picker":u.a},methods:{dateOnChange:function(t){this.$emit("change",t)},addDay:function(){this.$emit("change",v()(this.date).add(1,"day").format("YYYY-MM-DD"))},subDay:function(){this.$emit("change",v()(this.date).subtract(1,"day").format("YYYY-MM-DD"))}}},f=(a("x6SC"),a("KHd+")),w=a("ZUTo"),x=a.n(w),b=a("5Emp"),g=Object(f.a)(h,function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"select_with_icon"},[a("div",{staticClass:"input-select-wrapper"},[a("v-menu",{attrs:{"close-on-content-click":!1,"nudge-right":40,lazy:"",transition:"scale-transition","offset-y":"","full-width":"","max-width":"inherit","min-width":"290px"},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[a("input",t._g({staticClass:"date-input",attrs:{slot:"activator",type:"text","aria-label":"Date","aria-describedby":"document date",readonly:""},domProps:{value:t.date},slot:"activator"},s))]}}]),model:{value:t.dateSelection,callback:function(e){t.dateSelection=e},expression:"dateSelection"}},[t._v(" "),a("v-date-picker",{attrs:{"header-color":"appColor",value:t.date},on:{change:t.dateOnChange,input:function(e){t.dateSelection=!1}}})],1)],1),t._v(" "),a("button",{staticClass:"btn-move-date",attrs:{type:"button"},on:{click:t.subDay}},[a("i",{staticClass:"material-icons",staticStyle:{fill:"#394066"}},[t._v("arrow_back_ios")])]),t._v(" "),a("button",{staticClass:"btn-move-date",attrs:{type:"button"},on:{click:t.addDay}},[a("i",{staticClass:"material-icons"},[t._v("arrow_forward_ios")])])])},[],!1,null,"47c83202",null),_=g.exports;x()(g,{VDatePicker:u.a,VMenu:b.a});var C=a("j+oE"),y=a("gSaM"),R=a("VFPB"),k=a("eMga"),$=a("L2JU"),S=(a("M74m"),{props:["docId"],data:function(){return{selected:[],countRows:0,currentRow:0,editRow:{index:null,item:null,sum:0,comment:""},headers:[{text:"Category of expence",align:"left",sortable:!0,value:"item"},{text:"Amount",value:"sum",align:"left"},{text:"Comment",value:"comment",align:"left",class:"hidden-sm-and-down"}],modal:!1,active:null,dialog:!1,showWalletSelection:!1,processing:!1}},components:{VAlert:y.a,VDataTable:C.a,"v-date-control":_,"my-select":d.a,"tm-editRow":R.a},computed:c()({date:{get:function(){return this.$store.state.expenses.expenseObj.date},set:function(t){this.$store.commit("expenseUpdateDate",fDate)}},wallet:{get:function(){return this.$store.state.expenses.expenseObj.wallet},set:function(t){this.$store.commit("expenseUpdateWallet",t)}}},Object($.c)({id:function(t){return t.expenses.expenseObj.id},currency:function(t){return t.expenses.expenseObj.currency},rows:function(t){return t.expenses.expenseObj.rows},closeForm:function(t){return t.expenses.closeForm}}),Object($.b)({wallets:"allWallets",items:"allExpenseItems"}),{totalAmount:function(){var t=this.rows.reduce(function(t,e){return t+Number(e.sum)},0);return k.a.round2(t)}}),beforeMount:function(){this.$store.state.title="Expense",this.$store.commit("setupToolbarMenu",[]),this.$store.commit("setupToolbarMenu",this.getUpMenu()),this.$store.dispatch("getSettings"),this.$store.dispatch("getAllWallets"),this.$store.dispatch("getAllExpenseItems"),this.$store.dispatch("getExpense",this.docId)},watch:{closeForm:function(t,e){!0===t&&this.$router.push({path:"/expends"})}},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"Save",icon:"done",action:function(){t.save()}},menu:[{title:"Cancel",icon:"exit_to_app",action:function(){t.cancel()}}]}},startWalletChoice:function(){this.showWalletSelection=!0},completeWalletSelectionHandler:function(t){void 0!==t&&"object"===(void 0===t?"undefined":i()(t))&&this.walletOnChange(t),this.showWalletSelection=!1},deleteSelected:function(){this.$store.commit("deleteSelected",this.selected)},toggleAll:function(){this.selected.length?this.selected=[]:this.selected=this.rows.slice()},dateOnChange:function(t){this.$store.commit("expenseUpdateDate",t)},walletOnChange:function(t){this.$store.commit("expenseUpdateWallet",t)},editCurrentRow:function(t){this.editRow=n()({},t),this.editRow.index=this.rows.indexOf(t),this.dialog=!0},addNewLine:function(){this.tempRow=null,this.editRow={index:null,item:null,sum:0,comment:""},this.dialog=!0},closeEditRowDialog:function(){this.dialog=!1},saveRow:function(t){if(this.dialog=!1,t.item){if(null===t.index){var e=this.maxRowId();t.rowId=++e}this.$store.commit("expenseEditRow",t),this.editRow={index:null,item:null,sum:0,comment:""}}},maxRowId:function(){if(0==this.rows.length)return 0;var t=this.rows.reduce(function(t,e){return Math.max(t,e.rowId)},0);return t},deleteRow:function(t){this.$store.commit("expenseDeleteRow",t)},openFormItems:function(){this.dialog=!0},chooseItem:function(t){this.editRow.item=t,this.dialog=!1},save:function(){var t=this;this.processing=!0,this.$store.dispatch("saveExpense").then(function(){t.processing=!1,t.$router.push({path:"/expends"})}).catch(function(e){t.processing=!1})},cancel:function(){this.$router.push({path:"/expends"})}}}),V=(a("gwF3"),a("B5h7")),D=a("gzZi"),A=a("rHzn"),O=a("Ey0z"),M=a("jjY0"),j=a("mRA0"),T=a("cdmR"),E=a("Kn9U"),I=Object(f.a)(S,function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container-fluid expense-from"},[a("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:1==this.processing,expression:"this.processing == true"}],attrs:{indeterminate:!0}}),t._v(" "),a("form",[a("div",{staticClass:"row"},[a("div",{staticClass:"col-xs-12 col-sm-6"},[a("div",{staticClass:"form-group"},[a("label",{staticClass:"tm-input-label",attrs:{for:"expense_date_el"}},[t._v("Date")]),t._v(" "),a("v-date-control",{attrs:{date:t.date},on:{change:t.dateOnChange}})],1)])]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-xs-12 col-sm-6"},[a("div",{staticClass:"form-group"},[a("label",{staticClass:"tm-input-label",attrs:{for:"expense_wallet_el"}},[t._v("Wallet")]),t._v(" "),a("div",{staticClass:"select_with_icon"},[a("div",{staticClass:"input-select-wrapper"},[a("my-select",{staticClass:"style-chooser",staticStyle:{display:"flex","flex-grow":"5"},attrs:{id:"expense_wallet_el",options:t.wallets,label:"name"},model:{value:t.wallet,callback:function(e){t.wallet=e},expression:"wallet"}})],1),t._v(" "),a("button",{staticClass:"btn-open-selection",attrs:{type:"button"},on:{click:t.startWalletChoice}},[a("i",{staticClass:"material-icons"},[t._v("more_horiz")])])])])])]),t._v(" "),a("tm-wallets-select-form",{attrs:{items:this.wallets,showWalletSelection:this.showWalletSelection},on:{"select-wallets-close":t.completeWalletSelectionHandler}}),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12"},[a("tm-editRow",{attrs:{items:t.items,editRow:t.editRow,dialog:t.dialog},on:{close:t.closeEditRowDialog,done:t.saveRow}}),t._v(" "),a("div",{staticClass:"from-table-wrapper"},[a("v-toolbar",{attrs:{color:"appColor",dense:"",dark:""}},[a("v-toolbar-items",[a("v-btn",{attrs:{flat:"",dark:""},on:{click:function(e){return t.addNewLine()}}},[a("v-icon",{attrs:{left:"",dark:""}},[t._v("add")]),t._v("\n                                Add\n                            ")],1),t._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:this.selected.length>0,expression:"this.selected.length > 0"}],attrs:{flat:"",dark:""},on:{click:function(e){return t.deleteSelected()}}},[a("v-icon",[t._v("delete")]),t._v("\n                                Delete\n                            ")],1)],1),t._v(" "),a("v-spacer"),t._v(" "),a("v-toolbar-title",{attrs:{color:"white"}},[t._v("Total: "+t._s(t.totalAmount)+" ("+t._s(t.currency.short_name)+")\n                        ")])],1),t._v(" "),a("v-data-table",{staticClass:"elevation-1",attrs:{"select-all":"",headers:t.headers,items:t.rows,"item-key":"rowId",id:"table-of-expenses"},scopedSlots:t._u([{key:"headers",fn:function(e){return[a("th",[a("v-checkbox",{attrs:{"input-value":e.all,indeterminate:e.indeterminate,primary:"","hide-details":""},on:{click:t.toggleAll}})],1),t._v(" "),t._l(e.headers,function(e){return a("th",{key:e.text,class:e.class,attrs:{align:e.align}},[t._v("\n                                "+t._s(e.text)+"\n                            ")])})]}},{key:"items",fn:function(e){return[a("tr",[a("td",{staticClass:"d-none"},[t._v(t._s(e.item.item))]),t._v(" "),a("td",[a("v-checkbox",{attrs:{primary:"","hide-details":""},model:{value:e.selected,callback:function(a){t.$set(e,"selected",a)},expression:"props.selected"}})],1),t._v(" "),a("td",{staticClass:"text-xs-left",on:{click:function(a){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.item.name)+"\n                                ")]),t._v(" "),a("td",{staticClass:"text-xs-left",on:{click:function(a){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.sum)+"\n                                ")]),t._v(" "),a("td",{staticClass:"text-xs-left hidden-sm-and-down",on:{click:function(a){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.comment)+"\n                                ")])])]}}]),model:{value:t.selected,callback:function(e){t.selected=e},expression:"selected"}},[t._v(" "),t._v(" "),a("template",{slot:"no-data"},[a("v-alert",{attrs:{value:!0,type:"info",icon:"warning"}},[t._v('To add a new expense, click "Add"\n                            ')])],1)],2)],1)],1)])],1)],1)},[],!1,null,"31297ab9",null);e.default=I.exports;x()(I,{VAlert:V.a,VBtn:D.a,VCheckbox:A.a,VDataTable:C.a,VIcon:O.a,VProgressLinear:M.a,VSpacer:j.a,VToolbar:T.a,VToolbarItems:E.a,VToolbarTitle:E.b})},rotN:function(t,e,a){},x6SC:function(t,e,a){"use strict";var s=a("IxiZ");a.n(s).a}}]);