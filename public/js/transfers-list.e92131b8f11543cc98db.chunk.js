(window.webpackJsonp=window.webpackJsonp||[]).push([[21],{"/yjb":function(t,s,e){"use strict";var a=e("Xw7S");e.n(a).a},VIqb:function(t,s,e){"use strict";e.r(s);var a=e("QbLZ"),l=e.n(a),o=e("L2JU"),n={data:function(){return{title:"Transfers",processing:!1,offsetTop:0,offset:0,page:0,updating:!1,showDel:!1,currentPage:1,headers:[{text:"id",value:"id",classList:["d-none"]},{text:"Date",value:"date",classList:["col-xs-2 col-sm-2 col-lg-2"]},{text:"Wallet",value:"walletName",classList:["col-xs-2 col-sm-4 col-lg-4"]},{text:"Sum",value:"sum",classList:["col-xs-2 col-sm-4 col-lg-5"]}]}},computed:l()({},Object(o.b)({items:"items"})),beforeMount:function(){this.$store.state.title="Transfers",this.$store.commit("setupToolbarMenu",this.getUpMenu()),this.$store.dispatch("getTransfers",this.currentPage)},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"add",icon:"add",action:function(){t.add()}},menu:[{title:"update",icon:"update",action:function(){t.update()}}]}},editItem:function(t){var s=t.id;console.log("edit transfer by id "+s),this.$router.push({path:"transfers/"+s})},add:function(){this.$router.push({path:"transfers/new"})},addDocs:function(){1!=this.updating&&(this.offset+=50,this.updating=!0)},showDelBtn:function(){this.showDel=!this.showDel},deleteItem:function(t){alert("Action doesn't support yet")}}},i=(e("/yjb"),e("KHd+")),r=e("ZUTo"),c=e.n(r),u=e("Do8S"),d=e("pyJu"),f=Object(i.a)(n,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("v-layout",{attrs:{row:""}},[e("div",{staticClass:"table-wrapper"},[e("ul",{staticClass:"list-group list-group-flush"},[e("li",{staticClass:"list-group-item list-header"},[e("v-layout",{attrs:{row:"","ml-3":""}},[e("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[e("v-layout",{attrs:{row:""}},[e("v-flex",{staticClass:"cell",attrs:{xs8:"",sm8md10:"",lg10:""}},[e("v-layout",{staticClass:"flex-column flex-md-row",attrs:{row:"","d-flex":""}},[e("v-flex",{attrs:{xs4:""}},[e("span",[t._v("Date")])]),t._v(" "),e("v-flex",{attrs:{xs8:""}},[e("span",[t._v("Wallets (sum)")])])],1)],1)],1)],1),t._v(" "),e("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[e("div",{staticClass:"cell-actions justify-content-end"},[e("span",[t._v("Act.")])])])],1)],1),t._v(" "),t._l(t.items,function(s){return e("li",{staticClass:"list-group-item list-item",on:{click:function(e){return t.editItem(s)}}},[e("v-layout",{attrs:{row:"","ml-3":""}},[e("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[e("v-layout",{staticClass:"flex-column flex-md-row",attrs:{row:""}},[e("v-flex",{attrs:{xs12:"",sm12:"",md2:"",lg2:""}},[e("span",[t._v(t._s(s.date))])]),t._v(" "),e("v-flex",{attrs:{xs12:"",sm12:"",md10:"",lg10:""}},[e("v-flex",{attrs:{xs10:""}},[e("span",[t._v("from: "+t._s(s.wallet_from.name)+" ( - "+t._s(s.sum_from)+")")])]),t._v(" "),e("v-flex",{attrs:{xs10:""}},[e("span",[t._v("to: "+t._s(s.wallet_to.name)+" (+ "+t._s(s.sum_to)+")")])])],1)],1)],1),t._v(" "),e("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[e("div",{staticClass:"cell-actions justify-content-end"},[e("a",{staticClass:"delete",attrs:{"data-toggle":"modal"}},[t._v("\n                                del\n                                ")])])])],1)],1)})],2)])])},[],!1,null,"b2967a3c",null);s.default=f.exports;c()(f,{VFlex:u.a,VLayout:d.a})},Xw7S:function(t,s,e){}}]);