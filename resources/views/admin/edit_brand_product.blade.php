@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật thương hiệu sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($brands_product as $key => $value)
                            <div class="position-center">
                                <form role="form" action="{{route('admin.update_brand',$value->brand_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$value->brand_slug}}" name="brand_product_slug" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" >{{$value->brand_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <label>
                                        <select name="brand_product_status" class="form-control input-sm m-bot15">
                                              <option value="0">Ẩn</option>
                                              <option value="1">Hiển thị</option>

                                      </select>
                                    </label>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                                    <a class="btn btn-info" style="color:white;" href="{{route('admin.list_brand')}}">Trở về</a>
                                </form>
                            </div>
                            @endforeach

                          {{--   <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$brand_product->brand_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$brand_product->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$brand_product->brand_slug}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" >{{$brand_product->brand_desc}}</textarea>
                                </div>

                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div> --}}

                        </div>
                    </section>

            </div>
@endsection
