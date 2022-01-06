@php
function fetchTree($childs){

    foreach($childs as $child){
        if(count($child['childs'])){
            echo "<optgroup label='".$child['langs'][0]['name']."'>";
        }
        else{
            echo "<option value='".$child['id']."'>".$child['langs'][0]['name']."</option>";
        }
        if(count($child['childs'])){
            fetchTree($child['childs']);
            echo "</optgroup>";
        }

    }

}
@endphp
<div id="product-app">
    <form action="" method="post" refs="product-form" id="product_form">
        <div class="row">
            {{--  category  --}}
            <div class="col-md-6 form-group">
                <label>القسم</label>
                <select name="category_id" v-model="product.category_id" class="form-control" required="">
                    @foreach($category_tree as $cat)
                        @if(count($cat['childs']))
                        <optgroup label="--{{$cat['langs'][0]['name']}}--">
                            {!! fetchTree($cat['childs']) !!}
                        </optgroup>
                        @endif
                    @endforeach
                </select>
            </div>
            {{--  brands  --}}
            <div class="col-md-6 form-group">
                <label>الماركة</label>
                <select name="brand_id" v-model="product.brand_id" class="form-control" required="">
                    <option value="">--اختر الماركة--</option>
                    <option v-for="(brand,i) in brands" :key="'brand'+i" :value="brand.id" :selected="brand.id==product.brand_id">@{{brand.langs[0].name}}</option>
                </select>
            </div>
            {{--  price  --}}
            <div class="col-md-3 form-group">
                <label>السعر</label>
                <input type="number" min="1" step='any' name="price" v-model="product.price" class="form-control" required>
            </div>
            {{--  discount  --}}
            <div class="col-md-3 form-group">
                <label>نسبة الخصم %</label>
                <input type="number" min="1" name="discount" v-model="product.discount" class="form-control" required>
            </div>
            {{--  discount time  --}}
            <div class="col-md-3 form-group">
                <label>يتنهى العرض فى </label>
                <input type="date" name="discount_expire_at" v-model="product.discount_expire_at" class="form-control" required>
            </div>
            {{--  total stock  --}}
            <div class="col-md-3 form-group">
                <label>المخزون الكلى </label>
                <input type="number" min="0" name="stock" v-model="product.stock" class="form-control" required>
            </div>
            {{--  name  --}}
            <div v-if="langs.length" v-for="(language,i) in languages" :key="'name'+i" class="col-md-6 form-group">
                <label>الاسم (@{{language.name}})</label>
                <input type="text" :name="'lang['+language.id+'][name]'" v-model="langs[i].name" class="form-control" required="">
            </div>
            {{--  details  --}}
            <div v-if="langs.length" v-for="(language,i) in languages" :key="'details'+i" class="col-md-6 form-group" >
                <label>التفاصيل (@{{language.name}})</label>
                <textarea :name="'lang['+language.id+'][description]'" v-model="langs[i].description" cols="30" rows="7" class="form-control" required="">@{{langs[i]?langs[i].name:''}}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label for="main_image" class="uploader-label">الصورة الرئيسية <i class="fas fa-upload"></i></label>
                <input type="file" id="main_image" accept="image/*" class="d-none" @change="uploadImage($event,'image')" />
                <br>
                <div class="img-container">
                    <img v-if="product.image" :src="product.image"  width="100"/>
                </div>
            </div>
            <div class="col-md-6 form-group">
                <label for="all_images" class="uploader-label">الصورة الفرعية <i class="fas fa-upload"></i></label>
                <input type="file" id="all_images" multiple accept="image/*" class="d-none" @change="uploadImage($event,'all')" />
                <br>
                <div class="img-container" v-if="images.length" v-for="(row,i) in images">
                    <img :src="row.image" width="100" />
                    <a @click="deleteImage(i)" class="delete-image"><i class="fa fa-times-circle"></i></a>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                  <label for="">التاجات</label>
                  <select v-if="tags"  v-model="product_tags" class="form-control" multiple required="">
                      <option v-for="(row,i) in tags" :value="row.id" >@{{row.name}}</option>
                  </select>
                </div>
            </div>
            <div class="col-md-6">
                <label> Video </label>
                <input type="text"  name="video" v-model="product.video" class="form-control" >
           
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-sm btn-primary" @click="saveProduct()">حفظ</button>
                <span v-if="product.updated_at">@{{product.updated_at}}</span>
            </div>
            <hr>
        </div>
        <br><br>
        <div class="row" id="options" v-if="category_options">
            <div class="col-md-12">
                <h3>الخيارات</h3>
                <hr>
            </div>
            
            <table class="table table-responsive">
                <tr>
                    <th>#</th>
                    <th>option</th>
                    <th>value</th>
                    <th>actions</th>
                </tr>
                <tr v-for="(row,i) in product_options" :key="'viewoption'+i">
                    <td>@{{row.id}}</td>
                    <td>@{{getOptionName(row.option_id)}}</td>
                    <td v-if="row.has_value">@{{row.langs[0].value}}</td>
                    <td v-if="row.value_id">@{{getOptionValue(row.option_id,row.value_id)}}</td>
                    <td>
                        <a @click="deleteOption(row)"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                        <a @click="editOption(row)"><i class="fas fa-pen text-info"></i></a>
                    </td>
                </tr>
            </table>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-3 form-group">
                <label>اضافة اختيار </label>
                <select v-model="current_option" class="form-control">
                    <option v-for="(row,i) in category_options" :key="'option'+i" :value="row">@{{row.langs[0].name}}</option>
                </select>
            </div>
            <div v-if="current_option && current_option.affect_price" class="col-md-3 form-group">
                <label>السعر</label>
                <input type="number" v-model="product_option.price" class="form-control">
            </div>
            <div v-if="current_option && current_option.is_stock" class="col-md-3 form-group">
                <label>المخزون</label>
                <input type="number" min="1" v-model="product_option.stock" class="form-control">
            </div>
            <div v-if="current_option && selctor.indexOf(current_option.type) != -1" class="col-md-3 form-group">
                <label>القيمة</label>
                <select v-model="product_option.value_id" class="form-control">
                    <option v-for="(row,i) in current_option.values" :key="'value_id_'+i" :value="row.id">@{{row.langs[0].value}}</option>
                </select>
            </div>

            <div v-if="current_option!=undefined && selctor.indexOf(current_option.type) == -1" :data-test="selctor.indexOf(current_option.type)" class="col-md-5">
                <div  v-for="(row,i) in languages" :key="'value_input_'+i" class="form-group">
                    <label>القيمة (@{{row.name}})</label>
                    <input type="text"  v-model="product_option.langs[i].value" class="form-control">
                </div>
            </div>
            <div v-if="current_option" class="col-md-5">
                <br>
                <label for="option_images" class="uploader-label">صور الخاصية<i class="fas fa-upload"></i></label>
                <input type="file" id="option_images" multiple accept="image/*" class="d-none" @change="uploadImage($event,'option')" />
                <br>
                <div class="img-container" v-if="product_option.images.length" v-for="(row,i) in product_option.images">
                    <img :src="row.image" width="100" />
                    <a @click="()=>{product_option.images.splice(i,1)}" class="delete-image"><i class="fa fa-times-circle"></i></a>
                </div>
            </div>

            <div class="col-md-2 pt-4">
                <button v-if="current_option" type="button" class="btn btn-sm btn-secondary" @click="saveOption()">Save</button>
            </div>
        </div>
    </form>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        new Vue({
            el:"#product-app",
            data:{
                product_id:{{$product_id??'null'}},
                product:{
                    id:null,
                    category_id:null,
                    brand_id:null,
                    image:null,
                    price:0,
                    video:null,
                    stock:0,
                    discount:0,
                    discount_expire_at:null,
                    created_at:null,
                    updated_at:null
                },
                product_tags:[],
                lang:{
                    id:null,
                    name:'',
                    description:''
                },
                option_lang:{
                    id:null,
                    value:null,
                    value_id:null
                },
                langs:[],
                images:[],
                categories:[],
                brands:[],
                languages:[],
                category_options:[],
                product_options:[],
                selctor:[1,3,5],
                current_option:null,
                product_option:{
                    id:null,
                    product_id:null,
                    option_id:null,
                    value_id:null,
                    price:null,
                    stock:0,
                    has_value:false,
                    image:null,
                    langs:[]
                },
                tags:[]

            },
            created(){
                this.getLangauges();
                this.getBrands();
                if(this.product_id)
                    this.getProduct();
                this.getTags();
                    
            },
            watch:{
                languages: function (val) {
                    if(!this.product_id)
                        this.handelLangs();
                    this.handelOptionLangs();
                },
                product:function (val){
                    if(val.id){
                        this.getCategoryOption(val.category_id);
                        this.getProductOptios(val.id);
                    }
                },
                product_option:function(val){

                }        
            },
            methods:{
                getProduct(){
                    axios.get('./backend/products/get-product/'+this.product_id).then(res=>{
                        this.product=res.data.data['product'];
                        this.langs=res.data.data['langs'];
                        this.images=res.data.data['images'];
                        this.product_tags=res.data.data['tags'];
                    });
                },
                handelLangs(){
                    for(var i in this.languages){
                        var lang={...this.lang};
                        lang.lang_id=this.languages[i].id;
                        this.langs.push(lang);
                    }
                },
                handelOptionLangs(){
                    for(var i in this.languages){
                        var lang={...this.option_lang};
                        lang.lang_id=this.languages[i].id;
                        this.product_option.langs.push(lang);
                    }
                },
                getCategoryOption(category_id){
                    axios.get('./backend/products/get-category-options/'+category_id).then(res=>{
                        console.log(res.data.data);
                        this.category_options=res.data.data;
                    });
                },
                getLangauges(){
                    axios.get('./backend/get-languages').then(res=>{
                        this.languages=res.data.data;
                        //this.handelLangs();
                    })
                },
                getBrands(){
                    axios.get('./backend/get-brands').then(res=>{
                        this.brands=res.data.data;
                    });
                },
                saveProduct(){
//                    if(!this.validateProduct())
//                        return false
                    axios.post('./backend/products/save-product',
                            {product:this.product,langs:this.langs,images:this.images,tags:this.product_tags}
                    ).then(res=>{
                        if(res.data.status==false){
                     Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: res.data.errors.join('<br>'),
                          });
                        return false;
                      }
                        this.product=res.data.data['product'];
                        this.langs=res.data.data['langs'];
                        this.images=res.data.data['images'];
                         Swal.fire({
                            icon: 'success',
                            title: 'success',
                            message: 'تم الحفظ بنجاح',
                          });
                    });
                },
                saveOption(){
                    this.product_option.option_id=this.current_option.id;
                    this.product_option.product_id=this.product.id;
                    axios.post('./backend/products/save-option',{option:this.product_option,product_id:this.product.id}).then(res=>{
                        var option=res.data.data;
                        console.log(option);
                        for(var i in this.product_options){
                            if(this.product_options[i].id==option.id){
                                this.product_options.splice(i,1);
                            }
                        }
                        this.product_options.push(option);
                        this.emptyOption();
                    });
                },
                getOptionName(option_id){
                    for(var i in this.category_options){
                        if(option_id==this.category_options[i].id){
                            return this.category_options[i].langs[0].name;
                        }
                    }
                },
                getProductOptios(){
                    axios.get('./backend/products/get-options/'+this.product.id).then(res=>{
                        this.product_options=res.data.data;
                    });
                },
                getOptionValue(option_id,value_id){
                    for(var i in this.category_options){
                        if(option_id==this.category_options[i].id){
                            let values=this.category_options[i].values;
                            for(var x in values){
                                if(values[x].id==value_id){
                                    return values[x].langs[0].value;
                                }
                            }
                        }
                    }
                },
                editOption(option){
                    for(var i in this.category_options){
                        if(this.category_options[i].id==option.option_id)
                            this.current_option={...this.category_options[i]}
                    }
                    this.product_option={...option};
                },
                deleteOption(option){
                    axios.post('./backend/products/delete-option',{option_id:option.id}).then(res=>{
                        if(res.data.status){
                            alert(res.data.message);
                            for(var i in this.product_options){
                                if(option.id==this.product_options[i].id)
                                    this.product_options.splice(i,1);
                            }
                        }
                    });
                },
                emptyOption(){
                    this.current_option=null;
                    this.product_option={
                        id:null,
                        product_id:null,
                        option_id:null,
                        value_id:null,
                        price:null,
                        stock:0,
                        has_value:false,
                        image:null,
                        langs:[]
                    }
                },
                uploadImage(event,type){
                    //var files = this.$refs.myFiles.files
                    var files = event.target.files
                    let formData = new FormData();
                    for( var i=0; i<files.length; i++ ){
                        let file=files[i];
                        formData.append('images[' + i + ']', file);
                    }
                    axios.post( './backend/products/upload-images',formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                        }
                    ).then(res=>{
                        console.log('Type:'+type);
                        if(type=='image'){
                            this.product.image=res.data.data[0];
                            console.log('upload image');
                        }else if(type=='option'){
                            console.log('option upload image');
                            if(this.product_option.images==undefined)
                                Vue.set(this.product_option,'images',[]);
                            for(var i in res.data.data){
                                this.product_option.images.push({id:null,image:res.data.data[i]});
                            }
                        }else{
                            console.log('upload images');
                            for(var i in res.data.data){
                                this.images.push({id:null,image:res.data.data[i]});
                            }
                        }
                    });

                },
                deleteImage(index){
                    if(!confirm('هل تريد حذف الصورة ؟'))return false;
                    for(var i in this.images){
                        if(i==index)
                            this.images.splice(i,1);
                    }
                },
                getTags(){
                    axios.get('./backend/get-tags').then(res=>{
                        this.tags=res.data;
                    });
                },
                validateProduct(){
                    let errors=[];
                    if(this.product.category_id==null)
                        errors.push('يجب اختيار المنتج');
                    if(this.product.brand_id==null)
                        errors.push('يجب اختيار البراند');
                    if(this.product.price=='')
                        errors.push('يجب ادخال السعر');
                    if(this.product.stock==0)
                        errors.push('يجب ادخال المخزون');
                    for(let x in this.languages){
                        if(!this.langs || !this.langs[this.languages[x]] || this.langs[this.languages[x]].name=='')
                            errors.push('يجب ادخال اسم المنتج '+this.languages[x].name);
                        if(!this.langs || !this.langs[this.languages[x]] || this.langs[this.languages[x]].description=='')
                            errors.push('يجب ادخال تفاصيل المنتج '+this.languages[x].name);
                    }

                    if(errors.length){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: errors.join('<br>'),
                          });
                        return false;
                    }
                    return true;
                }

            }
        });
        
    </script>
    <style>
        .uploader-label{
            border: 1px solid;
            border-radius: 3px;
            padding: 9px;
            background-color: #00b5b8;
            color: white;
            cursor: pointer;
        }
        .img-container{
            display: inline-block;
            margin-right: 10px;
            position: relative;
            margin-bottom: 15px;
        }
        .delete-image{
            position: absolute;
            top: -10px;
            right: -10px;
            color: red !important;
        }
    </style>
@endpush