(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{"69lt":function(t,s,e){},R2WA:function(t,s,e){"use strict";var a=e("69lt");e.n(a).a},qSb6:function(t,s,e){"use strict";e.r(s);var a=new(e("Aozi").a),l={data:function(){return{items:[],title:"Incomes",processing:!1,offsetTop:0,offset:0,page:0,updating:!1,showDel:!1,pagination:{sortBy:"date",descending:!0,rowsPerPage:-1},headers:[{text:"id",value:"id",classList:["d-none"]},{text:"Date",value:"date",classList:["col-xs-2 col-sm-2 col-lg-2"]},{text:"Wallet",value:"walletName",classList:["col-xs-2 col-sm-4 col-lg-4"]},{text:"Sum",value:"sum",classList:["col-xs-2 col-sm-4 col-lg-5"]}]}},beforeMount:function(){this.$store.state.title="Incomes",this.$store.commit("setupToolbarMenu",this.getUpMenu())},created:function(){this.getDocs()},methods:{getUpMenu:function(){var t=this;return{mainAction:{title:"add",icon:"add",action:function(){t.add()}},menu:[{title:"update",icon:"update",action:function(){t.update()}}]}},getDocs:function(){var t=this;a.index("incomes",{page:this.page}).then(function(s){s.data.forEach(function(s){s.walletName=s.wallet.name,-1===t.items.indexOf(s)&&t.items.push(s)})})},editItem:function(t){var s=t.id;this.$router.push({path:"income/"+s})},add:function(){this.$router.push({path:"income/new"})},addDocs:function(){1!=this.updating&&(this.offset+=50,this.updating=!0,this.getDocs(this.offset))},showDelBtn:function(){this.showDel=!this.showDel},deleteItem:function(t){alert("Action doesn't support yet")},edit:function(t){this.$router.push({path:"income/"+t.id})}}},i=(e("R2WA"),e("KHd+")),n=e("ZUTo"),o=e.n(n),c=e("Do8S"),u=e("Ey0z"),r=e("pyJu"),d=Object(i.a)(l,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("v-layout",{attrs:{row:""}},[e("v-flex",{attrs:{xs12:"",sm12:"",md12:"",lg12:""}},[e("div",{staticClass:"table-wrapper"},[e("ul",{staticClass:"list-group list-group-flush"},[e("li",{staticClass:"list-group-item list-header"},[e("v-layout",{attrs:{row:"","ml-3":""}},[e("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[e("v-layout",{attrs:{row:""}},[e("v-flex",{staticClass:"cell",attrs:{xs8:"",sm8md10:"",lg10:""}},[e("v-layout",{staticClass:"flex-column flex-md-row",attrs:{row:"","d-flex":""}},[e("v-flex",{attrs:{xs4:""}},[e("span",[t._v("Date")])]),t._v(" "),e("v-flex",{attrs:{xs8:""}},[e("span",[t._v("Wallet")])])],1)],1),t._v(" "),e("v-flex",{attrs:{xs4:"",sm4:"",md2:"",lg2:""}},[e("div",{staticClass:"d-flex justify-content-end"},[e("span",[t._v("Sum")])])])],1)],1),t._v(" "),e("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[e("div",{staticClass:"cell-actions justify-content-end"},[e("span",[t._v("Act.")])])])],1)],1),t._v(" "),t._l(t.items,function(s){return e("li",{staticClass:"list-group-item list-item",on:{click:function(e){return t.editItem(s)}}},[e("v-layout",{attrs:{row:"","ml-3":""}},[e("v-flex",{staticClass:"cell",attrs:{xs10:"",sm10:"",md10:"",lg11:""}},[e("v-layout",{attrs:{row:""}},[e("v-flex",{staticClass:"cell",attrs:{xs8:"",sm8md10:"",lg10:""}},[e("v-layout",{staticClass:"flex-column flex-md-row",attrs:{row:"","d-flex":""}},[e("v-flex",{attrs:{xs4:""}},[e("span",[t._v(t._s(s.date))])]),t._v(" "),e("v-flex",{attrs:{xs8:""}},[e("span",[t._v(t._s(s.walletName))])])],1)],1),t._v(" "),e("v-flex",{attrs:{xs4:"",sm4:"",md2:"",lg2:""}},[e("div",{staticClass:"d-flex justify-content-end"},[e("span",[t._v(t._s(s.sum))])])])],1)],1),t._v(" "),e("v-flex",{attrs:{xs2:"",sm2:"",md2:"",lg1:""}},[e("div",{staticClass:"cell-actions justify-content-end"},[e("a",{staticClass:"delete",attrs:{"data-toggle":"modal"}},[e("v-icon",{attrs:{color:"#F44336"}},[t._v("delete")])],1)])])],1)],1)})],2)])])],1)},[],!1,null,"fa1708a8",null);s.default=d.exports;o()(d,{VFlex:c.a,VIcon:u.a,VLayout:r.a})}}]);