(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{"/aZD":function(t,e,n){"use strict";var o=n("1Don");n.n(o).a},"1Don":function(t,e,n){},"7Uct":function(t,e,n){"use strict";n.r(e);var o=n("P2sY"),i=n.n(o),s=n("EJiy"),a=n.n(s),r=n("QbLZ"),l=n.n(r),c=n("YEIV"),u=n.n(c),d=(n("Snq/"),n("ojEh")),h=n("cqWK"),p=n("j+oE"),f=n("gSaM"),m=n("VFPB"),v=n("eMga"),b=n("L2JU"),g=(n("M74m"),{props:["docId"],data:function(){var t;return t={menu:!1,toggle_multiple:[0,1],selected:[],countRows:0,currentRow:0,editRow:{index:null,item:null,sum:0,comment:""},headers:[{text:"Category",align:"left",sortable:!0,value:"item"},{text:"Amount",value:"sum",align:"left"},{text:"Comment",value:"comment",align:"left",class:"hidden-sm-and-down"}]},u()(t,"menu",!1),u()(t,"modal",!1),u()(t,"active",null),u()(t,"dialog",!1),u()(t,"showWalletSelection",!1),u()(t,"processing",!1),t},components:{VAlert:f.a,VDataTable:p.a,"tm-editRow":m.a,"tm-select":h.a,"v-date-control":d.a},computed:l()({wallet:{get:function(){return this.$store.state.incomes.incomeObj.wallet},set:function(t){this.$store.commit("incomeUpdateWallet",t)}}},Object(b.c)({id:function(t){return t.incomes.incomeObj.id},date:function(t){return t.incomes.incomeObj.date},currency:function(t){return t.incomes.incomeObj.currency},rows:function(t){return t.incomes.incomeObj.rows},closeForm:function(t){return t.incomes.closeForm}}),Object(b.b)({wallets:"allWallets",items:"allIncomeItems"}),{totalAmount:function(){var t=this.rows.reduce(function(t,e){return t+Number(e.sum)},0);return v.a.round2(t)}}),beforeMount:function(){this.$store.state.title="Income",this.$store.commit("setupToolbarMenu",[]),this.$store.commit("setupToolbarMenu",this.getUpMenu()),this.$store.dispatch("getSettings"),this.$store.dispatch("getAllWallets"),this.$store.dispatch("getAllIncomeItems"),this.$store.dispatch("getIncome",this.docId)},watch:{closeForm:function(t,e){!0===t&&this.$router.push({path:"/expends"})}},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"Save",icon:"done",action:function(){t.save()}},menu:[{title:"Cancel",icon:"exit_to_app",action:function(){t.cancel()}}]}},startWalletChoice:function(){this.showWalletSelection=!0},completeWalletSelectionHandler:function(t){void 0!==t&&"object"===(void 0===t?"undefined":a()(t))&&this.walletOnChange(t),this.showWalletSelection=!1},deleteSelected:function(){this.$store.commit("deleteSelected",this.selected)},toggleAll:function(){this.selected.length?this.selected=[]:this.selected=this.rows.slice()},dateOnChange:function(t){this.$store.commit("incomeUpdateDate",t)},walletOnChange:function(t){this.$store.commit("incomeUpdateWallet",t)},editCurrentRow:function(t){this.editRow=i()({},t),this.editRow.index=this.rows.indexOf(t),this.dialog=!0},addNewLine:function(){this.tempRow=null,this.editRow={index:null,item:null,sum:0,comment:""},this.dialog=!0},closeEditRowDialog:function(){this.dialog=!1},saveRow:function(t){if(this.dialog=!1,t.item){if(null===t.index){var e=this.maxRowId();t.rowId=++e}this.$store.commit("incomeEditRow",t),this.editRow={index:null,item:null,sum:0,comment:""}}},maxRowId:function(){if(0==this.rows.length)return 0;var t=this.rows.reduce(function(t,e){return Math.max(t,e.rowId)},0);return t},deleteRow:function(t){this.$store.commit("incomeDeleteRow",t)},openFormItems:function(){this.dialog=!0},chooseItem:function(t){this.editRow.item=t,this.dialog=!1},save:function(){var t=this;this.processing=!0,this.$store.dispatch("saveIncome").then(function(){t.processing=!1,t.$router.push({path:"/incomes"})}).catch(function(e){t.processing=!1})},cancel:function(){this.$router.push({path:"/incomes"})}}}),y=(n("aBKJ"),n("KHd+")),w=n("ZUTo"),_=n.n(w),S=n("B5h7"),x=n("gzZi"),O=n("rHzn"),C=n("Ey0z"),$=n("jjY0"),V=n("mRA0"),k=n("cdmR"),A=n("Kn9U"),T=Object(y.a)(g,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"row",attrs:{id:"income-form-root"}},[n("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:1==this.processing,expression:"this.processing == true"}],attrs:{indeterminate:!0}}),t._v(" "),n("form",{staticStyle:{"min-width":"100%"}},[n("div",{staticClass:"edit_from_header"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-sm-6"},[n("div",{staticClass:"form-group"},[n("label",{staticClass:"tm-input-label",attrs:{for:"expense_date_el"}},[t._v("Date")]),t._v(" "),n("v-date-control",{attrs:{date:t.date},on:{change:t.dateOnChange}})],1)])]),t._v(" "),n("div",{staticClass:"row d-flex"},[n("div",{staticClass:"col-xs-12 col-sm-6"},[n("div",{staticClass:"d-flex flex-wrap"},[n("div",{staticClass:"form-group"},[n("label",{staticClass:"tm-lable",attrs:{for:"wallet_sel"}},[t._v("Wallet:")]),t._v(" "),n("tm-select",{attrs:{id:"wallet_sel",options:t.wallets,title:"name",clearable:!0,"select-btn":!0,placeholder:"Select wallet"},on:{open:t.startWalletChoice},model:{value:t.wallet,callback:function(e){t.wallet=e},expression:"wallet"}})],1)])])]),t._v(" "),n("tm-wallets-select-form",{attrs:{items:this.wallets,showWalletSelection:this.showWalletSelection},on:{"select-wallets-close":t.completeWalletSelectionHandler}})],1),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-12"},[n("tm-editRow",{attrs:{items:t.items,editRow:t.editRow,dialog:t.dialog},on:{close:t.closeEditRowDialog,done:t.saveRow}}),t._v(" "),n("div",{staticClass:"from-table-wrapper"},[n("v-toolbar",{attrs:{color:"appColor",dense:"",dark:""}},[n("v-toolbar-items",[n("v-btn",{attrs:{flat:"",dark:""},on:{click:function(e){return t.addNewLine()}}},[n("v-icon",{attrs:{left:"",dark:""}},[t._v("add")]),t._v("\n                                Add\n                            ")],1),t._v(" "),n("v-btn",{directives:[{name:"show",rawName:"v-show",value:this.selected.length>0,expression:"this.selected.length > 0"}],attrs:{flat:"",dark:""},on:{click:function(e){return t.deleteSelected()}}},[n("v-icon",[t._v("delete")]),t._v("\n                                Delete\n                            ")],1)],1),t._v(" "),n("v-spacer"),t._v(" "),n("v-toolbar-title",{attrs:{color:"white"}},[t._v("Total: "+t._s(t.totalAmount)+" ("+t._s(t.currency.short_name)+")\n                        ")])],1),t._v(" "),n("v-data-table",{staticClass:"elevation-1",attrs:{"select-all":"",headers:t.headers,items:t.rows,"item-key":"rowId",id:"table-of-expenses"},scopedSlots:t._u([{key:"headers",fn:function(e){return[n("th",[n("v-checkbox",{attrs:{"input-value":e.all,indeterminate:e.indeterminate,primary:"","hide-details":""},on:{click:t.toggleAll}})],1),t._v(" "),t._l(e.headers,function(e){return n("th",{key:e.text,class:e.class,attrs:{align:e.align}},[t._v("\n                                "+t._s(e.text)+"\n                            ")])})]}},{key:"items",fn:function(e){return[n("tr",[n("td",{staticClass:"d-none"},[t._v(t._s(e.item.item))]),t._v(" "),n("td",[n("v-checkbox",{attrs:{primary:"","hide-details":""},model:{value:e.selected,callback:function(n){t.$set(e,"selected",n)},expression:"props.selected"}})],1),t._v(" "),n("td",{staticClass:"text-xs-left",on:{click:function(n){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.item.name)+"\n                                ")]),t._v(" "),n("td",{staticClass:"text-xs-left",on:{click:function(n){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.sum)+"\n                                ")]),t._v(" "),n("td",{staticClass:"text-xs-left hidden-sm-and-down",on:{click:function(n){return t.editCurrentRow(e.item)}}},[t._v("\n                                    "+t._s(e.item.comment)+"\n                                ")])])]}}]),model:{value:t.selected,callback:function(e){t.selected=e},expression:"selected"}},[t._v(" "),t._v(" "),n("template",{slot:"no-data"},[n("v-alert",{attrs:{value:!0,type:"info",icon:"warning"}},[t._v('To add a new income, click "Add"\n                            ')])],1)],2)],1)],1)])])],1)},[],!1,null,"4bef9d28",null);e.default=T.exports;_()(T,{VAlert:S.a,VBtn:x.a,VCheckbox:O.a,VDataTable:p.a,VIcon:C.a,VProgressLinear:$.a,VSpacer:V.a,VToolbar:k.a,VToolbarItems:A.a,VToolbarTitle:A.b})},M74m:function(t,e,n){},Rerx:function(t,e,n){},"Snq/":function(t,e,n){"undefined"!=typeof self&&self,t.exports=function(t){var e={};function n(o){if(e[o])return e[o].exports;var i=e[o]={i:o,l:!1,exports:{}};return t[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(o,i,function(e){return t[e]}.bind(null,i));return o},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=9)}([function(t,e){function n(t){return(n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function o(e){return"function"==typeof Symbol&&"symbol"===n(Symbol.iterator)?t.exports=o=function(t){return n(t)}:t.exports=o=function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":n(t)},o(e)}t.exports=o},function(t,e,n){},function(t,e){t.exports=function(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}},function(t,e,n){var o=n(5),i=n(6),s=n(7);t.exports=function(t){return o(t)||i(t)||s()}},function(t,e,n){var o=n(2);t.exports=function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{},i=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(i=i.concat(Object.getOwnPropertySymbols(n).filter(function(t){return Object.getOwnPropertyDescriptor(n,t).enumerable}))),i.forEach(function(e){o(t,e,n[e])})}return t}},function(t,e){t.exports=function(t){if(Array.isArray(t)){for(var e=0,n=new Array(t.length);e<t.length;e++)n[e]=t[e];return n}}},function(t,e){t.exports=function(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}},function(t,e){t.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}},function(t,e,n){"use strict";var o=n(1);n.n(o).a},function(t,e,n){"use strict";n.r(e);var o=n(3),i=n.n(o),s=n(2),a=n.n(s),r=n(0),l=n.n(r),c=n(4),u=n.n(c),d={watch:{typeAheadPointer:function(){this.maybeAdjustScroll()}},methods:{maybeAdjustScroll:function(){var t=this.pixelsToPointerTop(),e=this.pixelsToPointerBottom();return t<=this.viewport().top?this.scrollTo(t):e>=this.viewport().bottom?this.scrollTo(this.viewport().top+this.pointerHeight()):void 0},pixelsToPointerTop:function(){var t=0;if(this.$refs.dropdownMenu)for(var e=0;e<this.typeAheadPointer;e++)t+=this.$refs.dropdownMenu.children[e].offsetHeight;return t},pixelsToPointerBottom:function(){return this.pixelsToPointerTop()+this.pointerHeight()},pointerHeight:function(){var t=!!this.$refs.dropdownMenu&&this.$refs.dropdownMenu.children[this.typeAheadPointer];return t?t.offsetHeight:0},viewport:function(){return{top:this.$refs.dropdownMenu?this.$refs.dropdownMenu.scrollTop:0,bottom:this.$refs.dropdownMenu?this.$refs.dropdownMenu.offsetHeight+this.$refs.dropdownMenu.scrollTop:0}},scrollTo:function(t){return this.$refs.dropdownMenu?this.$refs.dropdownMenu.scrollTop=t:null}}},h={data:function(){return{typeAheadPointer:-1}},watch:{filteredOptions:function(){this.typeAheadPointer=0}},methods:{typeAheadUp:function(){this.typeAheadPointer>0&&(this.typeAheadPointer--,this.maybeAdjustScroll&&this.maybeAdjustScroll())},typeAheadDown:function(){this.typeAheadPointer<this.filteredOptions.length-1&&(this.typeAheadPointer++,this.maybeAdjustScroll&&this.maybeAdjustScroll())},typeAheadSelect:function(){this.filteredOptions[this.typeAheadPointer]?this.select(this.filteredOptions[this.typeAheadPointer]):this.taggable&&this.search.length&&this.select(this.search),this.clearSearchOnSelect&&(this.search="")}}},p={props:{loading:{type:Boolean,default:!1}},data:function(){return{mutableLoading:!1}},watch:{search:function(){this.$emit("search",this.search,this.toggleLoading)},loading:function(t){this.mutableLoading=t}},methods:{toggleLoading:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return this.mutableLoading=null==t?!this.mutableLoading:t}}};function f(t,e,n,o,i,s,a,r){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),o&&(c.functional=!0),s&&(c._scopeId="data-v-"+s),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},c._ssrRegister=l):i&&(l=r?function(){i.call(this,this.$root.$options.shadowRoot)}:i),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}var m={Deselect:f({},function(){var t=this.$createElement,e=this._self._c||t;return e("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg",width:"10",height:"10"}},[e("path",{attrs:{d:"M6.895455 5l2.842897-2.842898c.348864-.348863.348864-.914488 0-1.263636L9.106534.261648c-.348864-.348864-.914489-.348864-1.263636 0L5 3.104545 2.157102.261648c-.348863-.348864-.914488-.348864-1.263636 0L.261648.893466c-.348864.348864-.348864.914489 0 1.263636L3.104545 5 .261648 7.842898c-.348864.348863-.348864.914488 0 1.263636l.631818.631818c.348864.348864.914773.348864 1.263636 0L5 6.895455l2.842898 2.842897c.348863.348864.914772.348864 1.263636 0l.631818-.631818c.348864-.348864.348864-.914489 0-1.263636L6.895455 5z"}})])},[],!1,null,null,null).exports,OpenIndicator:f({},function(){var t=this.$createElement,e=this._self._c||t;return e("svg",{attrs:{xmlns:"http://www.w3.org/2000/svg",width:"14",height:"10"}},[e("path",{attrs:{d:"M9.211364 7.59931l4.48338-4.867229c.407008-.441854.407008-1.158247 0-1.60046l-.73712-.80023c-.407008-.441854-1.066904-.441854-1.474243 0L7 5.198617 2.51662.33139c-.407008-.441853-1.066904-.441853-1.474243 0l-.737121.80023c-.407008.441854-.407008 1.158248 0 1.600461l4.48338 4.867228L7 10l2.211364-2.40069z"}})])},[],!1,null,null,null).exports},v={components:u()({},m),mixins:[d,h,p],props:{value:{},components:{type:Object,default:function(){return{}}},options:{type:Array,default:function(){return[]}},disabled:{type:Boolean,default:!1},clearable:{type:Boolean,default:!0},searchable:{type:Boolean,default:!0},multiple:{type:Boolean,default:!1},placeholder:{type:String,default:""},transition:{type:String,default:"vs__fade"},clearSearchOnSelect:{type:Boolean,default:!0},closeOnSelect:{type:Boolean,default:!0},label:{type:String,default:"label"},autocomplete:{type:String,default:"off"},reduce:{type:Function,default:function(t){return t}},getOptionLabel:{type:Function,default:function(t){if("object"===l()(t)){if(!t.hasOwnProperty(this.label))return;return t[this.label]}return t}},getOptionKey:{type:Function,default:function(t){if("object"===l()(t)&&t.id)return t.id;try{return JSON.stringify(t)}catch(t){return}}},onTab:{type:Function,default:function(){this.selectOnTab&&this.typeAheadSelect()}},taggable:{type:Boolean,default:!1},tabindex:{type:Number,default:null},pushTags:{type:Boolean,default:!1},filterable:{type:Boolean,default:!0},filterBy:{type:Function,default:function(t,e,n){return(e||"").toLowerCase().indexOf(n.toLowerCase())>-1}},filter:{type:Function,default:function(t,e){var n=this;return t.filter(function(t){var o=n.getOptionLabel(t);return"number"==typeof o&&(o=o.toString()),n.filterBy(t,o,e)})}},createOption:{type:Function,default:function(t){return"object"===l()(this.optionList[0])&&(t=a()({},this.label,t)),this.$emit("option:created",t),t}},resetOnOptionsChange:{type:Boolean,default:!1},noDrop:{type:Boolean,default:!1},inputId:{type:String},dir:{type:String,default:"auto"},selectOnTab:{type:Boolean,default:!1},searchInputQuerySelector:{type:String,default:"[type=search]"}},data:function(){return{search:"",open:!1,pushedTags:[],_value:[]}},watch:{options:function(t){!this.taggable&&this.resetOnOptionsChange&&this.clearSelection(),this.value&&this.isTrackingValues&&this.setInternalValueFromOptions(this.value)},value:function(t){this.isTrackingValues&&this.setInternalValueFromOptions(t)},multiple:function(){this.clearSelection()}},created:function(){this.mutableLoading=this.loading,void 0!==this.value&&this.isTrackingValues&&this.setInternalValueFromOptions(this.value),this.$on("option:created",this.maybePushTag)},methods:{setInternalValueFromOptions:function(t){var e=this;Array.isArray(t)?this.$data._value=t.map(function(t){return e.findOptionFromReducedValue(t)}):this.$data._value=this.findOptionFromReducedValue(t)},select:function(t){this.isOptionSelected(t)||(this.taggable&&!this.optionExists(t)&&(t=this.createOption(t)),this.multiple&&(t=this.selectedValue.concat(t)),this.updateValue(t)),this.onAfterSelect(t)},deselect:function(t){var e=this;this.updateValue(this.selectedValue.filter(function(n){return!e.optionComparator(n,t)}))},clearSelection:function(){this.updateValue(this.multiple?[]:null)},onAfterSelect:function(t){this.closeOnSelect&&(this.open=!this.open,this.searchEl.blur()),this.clearSearchOnSelect&&(this.search="")},updateValue:function(t){var e=this;this.isTrackingValues&&(this.$data._value=t),null!==t&&(t=Array.isArray(t)?t.map(function(t){return e.reduce(t)}):this.reduce(t)),this.$emit("input",t)},toggleDropdown:function(t){var e=t.target,n=[this.$el,this.searchEl,this.$refs.toggle];void 0!==this.$refs.openIndicator&&n.push.apply(n,[this.$refs.openIndicator.$el].concat(i()(Array.prototype.slice.call(this.$refs.openIndicator.$el.childNodes)))),(n.indexOf(e)>-1||e.classList.contains("vs__selected"))&&(this.open?this.searchEl.blur():this.disabled||(this.open=!0,this.searchEl.focus()))},isOptionSelected:function(t){var e=this;return this.selectedValue.some(function(n){return e.optionComparator(n,t)})},optionComparator:function(t,e){if("object"!==l()(t)&&"object"!==l()(e)){if(t===e)return!0}else{if(t===this.reduce(e))return!0;if(this.getOptionLabel(t)===this.getOptionLabel(e)||this.getOptionLabel(t)===e)return!0;if(this.reduce(t)===this.reduce(e))return!0}return!1},findOptionFromReducedValue:function(t){var e=this;return this.options.find(function(n){return JSON.stringify(e.reduce(n))===JSON.stringify(t)})||t},closeSearchOptions:function(){this.open=!1,this.$emit("search:blur")},maybeDeleteValue:function(){if(!this.searchEl.value.length&&this.selectedValue&&this.clearable){var t=null;this.multiple&&(t=i()(this.selectedValue.slice(0,this.selectedValue.length-1))),this.updateValue(t)}},optionExists:function(t){var e=this;return this.optionList.some(function(n){return"object"===l()(n)&&e.getOptionLabel(n)===t||n===t})},normalizeOptionForSlot:function(t){return"object"===l()(t)?t:a()({},this.label,t)},maybePushTag:function(t){this.pushTags&&this.pushedTags.push(t)},onEscape:function(){this.search.length?this.search="":this.searchEl.blur()},onSearchBlur:function(){if(!this.mousedown||this.searching)return this.clearSearchOnBlur&&(this.search=""),void this.closeSearchOptions();this.mousedown=!1,0!==this.search.length||0!==this.options.length||this.closeSearchOptions()},onSearchFocus:function(){this.open=!0,this.$emit("search:focus")},onMousedown:function(){this.mousedown=!0},onMouseUp:function(){this.mousedown=!1},onSearchKeyDown:function(t){switch(t.keyCode){case 8:return this.maybeDeleteValue();case 9:return this.onTab()}},onSearchKeyUp:function(t){switch(t.keyCode){case 27:return this.onEscape();case 38:return t.preventDefault(),this.typeAheadUp();case 40:return t.preventDefault(),this.typeAheadDown();case 13:return t.preventDefault(),this.typeAheadSelect()}}},computed:{isTrackingValues:function(){return void 0===this.value||this.$options.propsData.hasOwnProperty("reduce")},selectedValue:function(){var t=this.value;return this.isTrackingValues&&(t=this.$data._value),t?[].concat(t):[]},optionList:function(){return this.options.concat(this.pushedTags)},searchEl:function(){return this.$scopedSlots.search?this.$refs.selectedOptions.querySelector(this.searchInputQuerySelector):this.$refs.search},scope:function(){var t=this;return{search:{attributes:{disabled:this.disabled,placeholder:this.searchPlaceholder,tabindex:this.tabindex,readonly:!this.searchable,id:this.inputId,"aria-expanded":this.dropdownOpen,"aria-label":"Search for option",ref:"search",role:"combobox",type:"search",autocomplete:"off",value:this.search},events:{keydown:this.onSearchKeyDown,keyup:this.onSearchKeyUp,blur:this.onSearchBlur,focus:this.onSearchFocus,input:function(e){return t.search=e.target.value}}},spinner:{loading:this.mutableLoading},openIndicator:{attributes:{ref:"openIndicator",role:"presentation",class:"vs__open-indicator"}}}},childComponents:function(){return u()({},m,this.components)},stateClasses:function(){return{"vs--open":this.dropdownOpen,"vs--single":!this.multiple,"vs--searching":this.searching&&!this.noDrop,"vs--searchable":this.searchable&&!this.noDrop,"vs--unsearchable":!this.searchable,"vs--loading":this.mutableLoading,"vs--disabled":this.disabled}},clearSearchOnBlur:function(){return this.clearSearchOnSelect&&!this.multiple},searching:function(){return!!this.search},dropdownOpen:function(){return!this.noDrop&&this.open&&!this.mutableLoading},searchPlaceholder:function(){if(this.isValueEmpty&&this.placeholder)return this.placeholder},filteredOptions:function(){var t=[].concat(this.optionList);if(!this.filterable&&!this.taggable)return t;var e=this.search.length?this.filter(t,this.search,this):t;return this.taggable&&this.search.length&&!this.optionExists(this.search)&&e.unshift(this.search),e},isValueEmpty:function(){return 0===this.selectedValue.length},showClearButton:function(){return!this.multiple&&this.clearable&&!this.open&&!this.isValueEmpty}}},b=(n(8),f(v,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"v-select",class:t.stateClasses,attrs:{dir:t.dir}},[n("div",{ref:"toggle",staticClass:"vs__dropdown-toggle",on:{mousedown:function(e){return e.preventDefault(),t.toggleDropdown(e)}}},[n("div",{ref:"selectedOptions",staticClass:"vs__selected-options"},[t._l(t.selectedValue,function(e){return t._t("selected-option-container",[n("span",{key:t.getOptionKey(e),staticClass:"vs__selected"},[t._t("selected-option",[t._v("\n            "+t._s(t.getOptionLabel(e))+"\n          ")],null,t.normalizeOptionForSlot(e)),t._v(" "),t.multiple?n("button",{staticClass:"vs__deselect",attrs:{disabled:t.disabled,type:"button","aria-label":"Deselect option"},on:{click:function(n){return t.deselect(e)}}},[n(t.childComponents.Deselect,{tag:"component"})],1):t._e()],2)],{option:t.normalizeOptionForSlot(e),deselect:t.deselect,multiple:t.multiple,disabled:t.disabled})}),t._v(" "),t._t("search",[n("input",t._g(t._b({staticClass:"vs__search"},"input",t.scope.search.attributes,!1),t.scope.search.events))],null,t.scope.search)],2),t._v(" "),n("div",{staticClass:"vs__actions"},[n("button",{directives:[{name:"show",rawName:"v-show",value:t.showClearButton,expression:"showClearButton"}],staticClass:"vs__clear",attrs:{disabled:t.disabled,type:"button",title:"Clear selection"},on:{click:t.clearSelection}},[n(t.childComponents.Deselect,{tag:"component"})],1),t._v(" "),t._t("open-indicator",[t.noDrop?t._e():n(t.childComponents.OpenIndicator,t._b({tag:"component"},"component",t.scope.openIndicator.attributes,!1))],null,t.scope.openIndicator),t._v(" "),t._t("spinner",[n("div",{directives:[{name:"show",rawName:"v-show",value:t.mutableLoading,expression:"mutableLoading"}],staticClass:"vs__spinner"},[t._v("Loading...")])],null,t.scope.spinner)],2)]),t._v(" "),n("transition",{attrs:{name:t.transition}},[t.dropdownOpen?n("ul",{ref:"dropdownMenu",staticClass:"vs__dropdown-menu",attrs:{role:"listbox"},on:{mousedown:t.onMousedown,mouseup:t.onMouseUp}},[t._l(t.filteredOptions,function(e,o){return n("li",{key:t.getOptionKey(e),staticClass:"vs__dropdown-option",class:{"vs__dropdown-option--selected":t.isOptionSelected(e),"vs__dropdown-option--highlight":o===t.typeAheadPointer},attrs:{role:"option"},on:{mouseover:function(e){t.typeAheadPointer=o},mousedown:function(n){return n.preventDefault(),n.stopPropagation(),t.select(e)}}},[t._t("option",[t._v("\n          "+t._s(t.getOptionLabel(e))+"\n        ")],null,t.normalizeOptionForSlot(e))],2)}),t._v(" "),t.filteredOptions.length?t._e():n("li",{staticClass:"vs__no-options",on:{mousedown:function(t){t.stopPropagation()}}},[t._t("no-options",[t._v("Sorry, no matching options.")])],2)],2):t._e()])],1)},[],!1,null,null,null).exports),g={ajax:p,pointer:h,pointerScroll:d};n.d(e,"VueSelect",function(){return b}),n.d(e,"mixins",function(){return g}),e.default=b}])},VFPB:function(t,e,n){"use strict";var o=n("uq+K"),i=n("eMga"),s={name:"AddRowFrom",props:{dialog:{type:Boolean,default:!1},editRow:{type:Object},items:{type:Array,default:[]}},data:function(){return{fullscreen:!1}},computed:{amount:{get:function(){return this.editRow.sum},set:function(t){this.editRow.sum=i.a.round2(Number(t))}}},components:{VAutocomplete:o.a},methods:{close:function(){this.$emit("close")},saveRow:function(){this.$emit("done",this.editRow)}}},a=(n("/aZD"),n("KHd+")),r=n("ZUTo"),l=n.n(r),c=n("xqZp"),u=n("gzZi"),d=n("sK+t"),h=n("mdmw"),p=n("FpqX"),f=n("mRA0"),m=n("Jnd4"),v=n("qEQh"),b=n("cdmR"),g=Object(a.a)(s,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-dialog",{staticClass:"form-dialog-bottom form-dialog",attrs:{"max-width":"550px",persistent:"",fullscreen:t.$vuetify.breakpoint.smAndDown},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[n("v-toolbar",{staticClass:"form-dialog-top",attrs:{dense:"",color:"appColor",dark:""}},[n("v-btn",{attrs:{flat:""},on:{click:t.close}},[t._v("Close")]),t._v(" "),n("v-spacer"),t._v(" "),n("v-btn",{attrs:{flat:""},on:{click:function(e){return t.saveRow(t.editRow)}}},[t._v("Ok")])],1),t._v(" "),n("v-card",{staticClass:"form-dialog-bottom"},[n("v-card-text",[n("div",{staticClass:"row"},[n("div",{staticClass:"col-xs-12 col-sm-6"},[n("v-autocomplete",{attrs:{label:"Item",items:t.items,autocomplete:"true","cache-items":"",clearable:"",outline:"","single-line":"","item-text":"name","item-value":"id","return-object":""},model:{value:t.editRow.item,callback:function(e){t.$set(t.editRow,"item",e)},expression:"editRow.item"}})],1),t._v(" "),n("div",{staticClass:"col-xs-12 col-sm-6"},[n("v-text-field",{attrs:{outline:"",type:"number",clearable:"",label:"Amount"},model:{value:t.amount,callback:function(e){t.amount=t._n(e)},expression:"amount"}})],1)]),t._v(" "),n("div",{staticClass:"row"},[n("div",{staticClass:"col-12"},[n("v-textarea",{attrs:{outline:"",label:"Comment"},model:{value:t.editRow.comment,callback:function(e){t.$set(t.editRow,"comment",e)},expression:"editRow.comment"}})],1)])])],1)],1)},[],!1,null,"a8fe3c7c",null);e.a=g.exports;l()(g,{VAutocomplete:c.a,VBtn:u.a,VCard:d.a,VCardText:h.b,VDialog:p.a,VSpacer:f.a,VTextField:m.a,VTextarea:v.a,VToolbar:b.a})},YEIV:function(t,e,n){"use strict";e.__esModule=!0;var o=function(t){return t&&t.__esModule?t:{default:t}}(n("SEkw"));e.default=function(t,e,n){return e in t?(0,o.default)(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}},aBKJ:function(t,e,n){"use strict";var o=n("nkyy");n.n(o).a},nkyy:function(t,e,n){},ojEh:function(t,e,n){"use strict";var o=n("Lku0"),i=n("Mm0z"),s=n("wd/R"),a=n.n(s),r={name:"TMDateControl",props:{date:{type:String,required:!0},label:{type:String,default:"Date"}},data:function(){return{dateSelection:!1}},components:{VMenu:i.a,"v-date-picker":o.a},methods:{dateOnChange:function(t){this.$emit("change",t)},addDay:function(){this.$emit("change",a()(this.date).add(1,"day").format("YYYY-MM-DD"))},subDay:function(){this.$emit("change",a()(this.date).subtract(1,"day").format("YYYY-MM-DD"))}}},l=(n("tNY0"),n("KHd+")),c=n("ZUTo"),u=n.n(c),d=n("5Emp"),h=Object(l.a)(r,function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"tm_select_wrapper"},[n("div",{staticClass:"tm_select_input_wrapper"},[n("v-menu",{attrs:{"close-on-content-click":!1,"nudge-right":40,lazy:"",transition:"scale-transition","offset-y":"","full-width":"","max-width":"inherit","min-width":"290px"},scopedSlots:t._u([{key:"activator",fn:function(e){var o=e.on;return[n("input",t._g({staticClass:"date-input",attrs:{slot:"activator",type:"text","aria-label":"Date","aria-describedby":"document date",readonly:""},domProps:{value:t.date},slot:"activator"},o))]}}]),model:{value:t.dateSelection,callback:function(e){t.dateSelection=e},expression:"dateSelection"}},[t._v(" "),n("v-date-picker",{attrs:{"header-color":"appColor",value:t.date},on:{change:t.dateOnChange,input:function(e){t.dateSelection=!1}}})],1)],1),t._v(" "),n("div",{staticClass:"btn_wrapper"},[n("button",{staticClass:"btn-move-date",attrs:{type:"button"},on:{click:t.subDay}},[n("i",{staticClass:"material-icons",staticStyle:{fill:"#394066"}},[t._v("arrow_back_ios")])]),t._v(" "),n("button",{staticClass:"btn-move-date",attrs:{type:"button"},on:{click:t.addDay}},[n("i",{staticClass:"material-icons"},[t._v("arrow_forward_ios")])])])])},[],!1,null,"27355b97",null);e.a=h.exports;u()(h,{VDatePicker:o.a,VMenu:d.a})},tNY0:function(t,e,n){"use strict";var o=n("Rerx");n.n(o).a}}]);