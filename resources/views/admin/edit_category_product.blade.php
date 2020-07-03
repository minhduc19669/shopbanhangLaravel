@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật danh mục sản phẩm
                        </header>
                         {{-- <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?> --}}
                        <div class="panel-body">
                            {{-- @foreach($edit_category_product as $key => $edit_value) --}}
                            @foreach ($product as $item)

                            <div class="position-center">
                                <form role="form" action="{{ route('admin.updateCategoryProduct', ['id'=>$item->category_id]) }}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" value="{{$item->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                  <input type="text" value="{{$item->slug_category_product}}" name="slug_category_product" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="exampleInputPassword1">
                                        {{$item->category_desc}}
                                    </textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa danh mục</label>
                                 <textarea style="resize: none" rows="8" class="form-control" name="category_product_keywords" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$item->meta_keywords}}</textarea>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div>
                            @endforeach
                            {{-- @endforeach --}}
                        </div>
                    </section>
            </div>
@endsection
