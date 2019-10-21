(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{"3ZwG":function(t,e,a){"use strict";var i=a("x+fa");a.n(i).a},iq0E:function(t,e,a){"use strict";a.r(e);var i=a("P2sY"),s=a.n(i),n=a("QbLZ"),l=a.n(n),o=a("zCDB"),r=a("L2JU"),c=a("Aozi"),d=new c.a,m={name:"WalletElement",props:{item:{type:Object,required:!0}},data:function(){return{title:"New",formData:{id:null,name:"",currency_id:"",is_creditcard:!1,grace_period:0,credit_limit:0,balance:0,newBalance:0},serverData:{id:null,name:"",currency_id:"",is_creditcard:!1,grace_period:0,credit_limit:0},processing:!1}},components:{VChip:o.a},computed:l()({},Object(r.b)({currencies:"allCurrencies"})),created:function(){this.$store.dispatch("getAllCurrencies"),this.formData=s()({},this.item),this.title=this.item.id?this.item.name:"new"},methods:{close:function(){this.$emit("cancel")},store:function(){var t=this;this.processing=!0,this.copyObject(this.serverData,this.formData),this.serverData.currency_id=this.formData.currency.id;(this.formData.id?d.update("wallets",this.serverData.id,this.serverData):d.store("wallets",this.serverData)).then(function(e){t.processing=!1,t.$emit("stored")}).catch(function(e){t.processing=!1})}}},u=a("KHd+"),h=a("ZUTo"),f=a.n(h),v=a("ghKu"),p=a("gzZi"),g=a("sK+t"),w=a("mdmw"),_=a("rHzn"),x=a("pSOK"),D=a("Do8S"),C=a("Ey0z"),b=a("jjY0"),y=a("tW1d"),I=a("mRA0"),k=a("Jnd4"),B=a("cdmR"),V=a("Kn9U"),F=Object(u.a)(m,function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-toolbar",{attrs:{color:"appColor",dark:""}},[a("v-toolbar-title",[t._v("Wallet: "+t._s(t.title))]),t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{icon:""}},[a("v-icon",[t._v("account_balance_wallet")])],1)],1),t._v(" "),a("v-card-text",[a("v-container",{attrs:{"grid-list-md":""}},[a("v-flex",{attrs:{xs12:"",sm12:"",md12:"","d-none":""}},[a("v-text-field",{attrs:{label:"id"},model:{value:t.formData.id,callback:function(e){t.$set(t.formData,"id",e)},expression:"formData.id"}})],1),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 col-sm-12 col-md-12 col-lg-12"},[a("v-text-field",{attrs:{label:"Name","row-height":"15"},model:{value:t.formData.name,callback:function(e){t.$set(t.formData,"name",e)},expression:"formData.name"}})],1)]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 col-sm-12 col-md-12 col-lg-12"},[a("v-select",{attrs:{items:t.currencies,"max-height":"15",auto:"",label:"Currency","single-line":"","item-text":"name","item-value":"id","return-object":""},model:{value:t.formData.currency,callback:function(e){t.$set(t.formData,"currency",e)},expression:"formData.currency"}})],1)]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-12 col-sm-12 col-md-12 col-lg-12"},[a("v-checkbox",{attrs:{label:"Is credit card","true-value":"1","false-value":"0"},model:{value:t.formData.is_creditcard,callback:function(e){t.$set(t.formData,"is_creditcard",e)},expression:"formData.is_creditcard"}})],1)]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-6 col-sm-6 col-md-6 col-lg-6"},[a("v-text-field",{directives:[{name:"show",rawName:"v-show",value:1==t.formData.is_creditcard,expression:"formData.is_creditcard == 1"}],attrs:{label:"Credit limit","row-height":"15"},model:{value:t.formData.credit_limit,callback:function(e){t.$set(t.formData,"credit_limit",e)},expression:"formData.credit_limit"}})],1),t._v(" "),a("div",{staticClass:"col-6 col-sm-6 col-md-6 col-lg-6"},[a("v-text-field",{directives:[{name:"show",rawName:"v-show",value:1==t.formData.is_creditcard,expression:"formData.is_creditcard == 1"}],attrs:{label:"Grace period","row-height":"15"},model:{value:t.formData.grace_period,callback:function(e){t.$set(t.formData,"grace_period",e)},expression:"formData.grace_period"}})],1)]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"text-xs-center"},[a("v-chip",{attrs:{color:"green","text-color":"white"}},[a("v-avatar",{staticClass:"green darken-4"},[a("v-icon",[t._v("edit")])],1),t._v("\n                        Balance: "+t._s(t.formData.balance)+"\n                    ")],1)],1)])],1)],1),t._v(" "),a("v-card-actions",[a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:function(e){return t.close()}}},[t._v("Cancel")]),t._v(" "),a("v-spacer"),t._v(" "),a("v-btn",{attrs:{disabled:1==this.processing,color:"green darken-3",flat:""},on:{click:function(e){return t.store()}}},[t._v("\n            Save\n        ")])],1),t._v(" "),a("v-progress-linear",{directives:[{name:"show",rawName:"v-show",value:this.processing,expression:"this.processing"}],attrs:{indeterminate:!0}},[a("p",[t._v("process")])])],1)},[],!1,null,"1e6ff250",null),$=F.exports;f()(F,{VAvatar:v.a,VBtn:p.a,VCard:g.a,VCardActions:w.a,VCardText:w.b,VCheckbox:_.a,VChip:o.a,VContainer:x.a,VFlex:D.a,VIcon:C.a,VProgressLinear:b.a,VSelect:y.a,VSpacer:I.a,VTextField:k.a,VToolbar:B.a,VToolbarTitle:V.b});var E=a("vVOz"),N=a("wd/R"),T=a.n(N),A=new c.a,j={data:function(){return{showElementForm:!1,modelName:"wallet",showDeleteConfirmation:!1,itemForDel:null,dialogCB:!1,formTitle:"New",title:"Wallets",processing:!1,offsetTop:0,offset:0,updating:!1,curr:null,headers:[{text:"id",value:"id",classList:["d-none"]},{text:"Name",value:"name",classList:["lg5"]},{text:"Currency",value:"currencyName",classList:["lg5"]}],element_id:"",editedIndex:-1,editedItem:null,newItem:{id:null,name:"",currency_id:"",currency:null,is_creditcard:!1,grace_period:0,credit_limit:0,currentBalance:0,newBalance:0},msgSettings:{show:!1,color:"light-green darken-3",mode:"vertical",timeout:6e3,msg:""}}},components:{"wallet-element":$,"tm-modal-del":E.a},computed:l()({},Object(r.b)({items:"allWalletsList"})),watch:{dialog:function(t){t||this.close()}},beforeMount:function(){this.$store.state.title="Wallets",this.$store.dispatch("getAllWalletsList"),this.$store.commit("setupToolbarMenu",this.getUpMenu())},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"add",icon:"add",action:function(){t.add()}},menu:[{title:"update",icon:"update",action:function(){t.update()}}]}},update:function(){0==this.updating&&(this.updating=!0,this.$store.dispatch("getAllWalletsList"),this.updating=!1)},edit:function(t){var e=this;this.element_id=t.id,A.show("wallets",t.id,{withbalance:!0}).then(function(t){console.dir(t),e.editedItem=s()({},t),e.showElementForm=!0}).catch(function(t){console.dir(t)})},add:function(){this.editedItem=s()({},this.newItem),this.showElementForm=!0},showDeleteConfirm:function(t){this.itemForDel=t,this.showDeleteConfirmation=!0},closeDeleteConfirmation:function(){this.showDeleteConfirmation=!1,this.itemForDel=null},deleteItem:function(t){var e=this;this.showDeleteConfirmation=!1,this.processing=!0,A.delete("wallets",this.itemForDel.id).then(function(t){alert(e.itemForDel.name+" was deleted!"),e.$store.dispatch("getAllWalletsList")}).catch(function(t){alert(e.itemForDel.name+" wasn't deleted!")}).finally(function(){e.itemForDel=null,e.processing=!1})},openChangeBalance:function(){this.editedItem.newBalance=this.editedItem.currentBalance,this.dialogCB=!0},changeBalance:function(){var t=this;if(this.editedItem.newBalance!==this.editedItem.currentBalance){var e=this.editedItem.newBalance-this.editedItem.currentBalance,a={model:"changebalance",data:{date:T()().format("YYYY-MM-DD"),wallet_id:this.editedItem.id,sumExpend:e<0?-1*e:0,sumIncome:e>0?e:0,newBalance:Number(this.editedItem.newBalance)}};Api.save(a).then(function(e){!0===e&&(t.checkBalance(t.editedItem.id),t.dialogCB=!1)})}else this.dialogCB=!1},checkBalance:function(t){var e=this,a={url:"/wallets/balance",conditions:{id:t}};Api.index(a).then(function(t){e.$set(e.editedItem,"currentBalance",t.balance)})},close:function(){var t=this;this.dialog=!1,this.formTitle="New",setTimeout(function(){t.editedItem=s()({},t.defaultItem),t.editedIndex=-1},300)},save:function(){this.sendData(this.editedItem)&&(this.close(),this.items=[],this.getItems(this.offset))},showMsg:function(t){this.msgSettings.color=t?"light-green darken-3":"orange darken-4",this.msgSettings.msg=t?"Saved/Updated successfully!":"Error",this.msgSettings.show=!0},onScroll:function(t){this.offsetTop=t.target.scrollTop,t.target.scrollTop/t.target.scrollTopMax*100>70&&(this.offset+=50,this.getItems(this.offset))}}},L=(a("3ZwG"),a("FpqX")),S=a("pyJu"),O=Object(u.a)(j,function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-container",{attrs:{"px-0":"","mx-0":""}},[a("v-layout",[a("v-flex",{attrs:{xs12:"",sm12:"",md12:"",lg12:""}},[t.showElementForm?a("v-dialog",{attrs:{"max-width":"500px",persistent:"",fullscreen:t.$vuetify.breakpoint.xsOnly},model:{value:t.showElementForm,callback:function(e){t.showElementForm=e},expression:"showElementForm"}},[a("wallet-element",{attrs:{item:this.editedItem},on:{cancel:function(e){t.showElementForm=!1},stored:function(e){t.showElementForm=!1,t.update()}}})],1):t._e(),t._v(" "),a("div",{staticClass:"table-wrapper"},[a("ul",{staticClass:"list-group list-group-flush"},[a("li",{staticClass:"list-group-item list-header"},[a("v-layout",{attrs:{row:"","ml-3":""}},[a("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[a("v-layout",{attrs:{row:""}},[a("v-flex",{attrs:{xs6:"",sm6:""}},[a("span",[t._v("Name")])]),t._v(" "),a("v-flex",{attrs:{xs3:"",sm3:""}},[a("span",[t._v("Currency")])])],1)],1),t._v(" "),a("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[a("div",{staticClass:"cell-actions justify-content-end"},[a("span",[t._v("Act.")])])])],1)],1),t._v(" "),t._l(t.items,function(e){return a("li",{staticClass:"list-group-item list-item",on:{click:function(a){return t.edit(e)}}},[a("v-layout",{attrs:{row:"","ml-3":""}},[a("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[a("v-layout",{attrs:{row:""}},[a("v-flex",{attrs:{xs6:"",sm6:""}},[a("span",[t._v(t._s(e.name))])]),t._v(" "),a("v-flex",{attrs:{xs6:"",sm6:""}},[a("span",[t._v(t._s(e.currency.short_name))])])],1)],1),t._v(" "),a("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[a("div",{staticClass:"cell-actions justify-content-end"},[a("a",{staticClass:"delete",attrs:{"data-toggle":"modal"},on:{click:function(a){return a.stopPropagation(),a.preventDefault(),t.showDeleteConfirm(e)}}},[a("v-icon",{attrs:{color:"#F44336"}},[t._v("delete")])],1)])])],1)],1)})],2)]),t._v(" "),a("tm-modal-del",{directives:[{name:"show",rawName:"v-show",value:this.showDeleteConfirmation,expression:"this.showDeleteConfirmation"}],attrs:{dialog:this.showDeleteConfirmation,modelName:this.modelName},on:{close:function(e){return t.closeDeleteConfirmation()},confirm:t.deleteItem}})],1)],1)],1)},[],!1,null,"64080ca8",null);e.default=O.exports;f()(O,{VContainer:x.a,VDialog:L.a,VFlex:D.a,VIcon:C.a,VLayout:S.a})},"x+fa":function(t,e,a){}}]);