@extends('layouts.admin')
@section('content')
    <div class="content">         

        <div class="row">           
                <div class="col-md-12">
                    <div class="d-flex">
                         <span class="h3">{{$title}}</span>
                         <span class="btn btn-primary" id="add_new_Restaurant" style="float: right;" data-toggle="modal" data-target="#myModal">Add Restaurant</span>
                    </div>
                   

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Restaurant Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($restaurant)
                                @foreach ($restaurant as $list)
                                    <tr>
                                        <td>{{ $list->Rest_Name }}</td>
                                        <td>{{ $list->Rest_Code }}</td>
                                        <td>{{ $list->Rest_Desc }}</td>
                                        <td>{{ $list->phone }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td><img src="{{url($list->image)}}" class="img-thumbnail" style="height: 75px;"> </td>
                                        <td class="d-flex"><span class="btn btn-sm btn-info mr-3 btn_edit"   data-toggle="modal" datalist="{{$list->id}}">Edit</span> 
                                          <!-- <a class="btn btn-sm btn-danger mr-3 btn_delete" href="{ {url('admin/Restaurant')} }/{ {$ list->id} }">Delete</a> -->
                                          <form action="{{ url('admin/Restaurant' , $list->id) }}" method="POST" class="mt-2">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-danger btn_delete">Delete</button>
</form>

                                        </td>
                                    </tr>
                               @endforeach
                            @else
                                <tr>
                                    <td colspan="7">Not Existing...</td>
                                </tr> 
                            @endif  
                        </tbody>
                    </table>                    
                </div>            
        </div>
        <div>
           @if($errors->any())
                          <div class="alert alert-danger col-12">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <br/>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
        </div>
         
    </div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Restaurant</h4>
        </div>
        <div class="modal-body">
         <form class="form-horizontal" id="basic-form1" action="{{url('admin/Restaurant')}}" method="post" enctype="multipart/form-data">
            @csrf  
       
            <div class="form-group">
              <label class="control-label col-sm-4" for="name">Restaurant Name:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="name" placeholder="Enter Restaurant Name" name="name" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Code">Restaurant Code:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="Code" placeholder="Enter Restaurant Code" name="Code" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="description">Description:</label>
              <div class="col-sm-8">
                <textarea name="Description" rows="3" class="form-control" id="Description" placeholder="Restaurant Description" required=""></textarea>                
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Phone">Phone:</label>
              <div class="col-sm-8">          
                <input type="text" class="form-control" id="Phone" placeholder="Enter Phone" minlength="10" maxlength="10" name="Phone" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">Email:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Image">Restaurant Image:</label>
              <div class="col-sm-8">          
                <input type="file" class="form-control" id="Image"  name="Image" accept="image/png, image/gif" required="">
              </div>
            </div>             
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-secondary mr-4" id="add_reset">Reset</button>
                <button type="submit" class="btn btn-info">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>
  <!-- ------------------------- -->

  <!-- Modal 2 -->
  <div class="modal fade" id="EditModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Restaurant</h4>
        </div>
        <div class="modal-body">
         <form class="form-horizontal" id="update-form" action="{{url('admin/Restaurant')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-sm-4" for="name">Restaurant Name:</label>
              <div class="col-sm-8">
                <input type="hidden" class="form-control" id="up_restid" placeholder="" name="up_restid" required="">
                <input type="text" class="form-control" id="up_name" placeholder="Enter Restaurant Name" name="name" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Code">Restaurant Code:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="up_Code" placeholder="Enter Restaurant Code" name="Code" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="description">Description:</label>
              <div class="col-sm-8">
                <textarea name="Description" rows="3" class="form-control" id="up_Description" placeholder="Restaurant Description" required=""></textarea>                
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Phone">Phone:</label>
              <div class="col-sm-8">          
                <input type="text" class="form-control" id="up_Phone" placeholder="Enter Phone" minlength="10" maxlength="10" name="Phone" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">Email:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="up_email" placeholder="Enter email" name="email" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Image">Restaurant Image:</label>
              <div class="col-sm-8">          
                <input type="file" class="form-control" id="up_Image"  name="Image" accept="image/png, image/gif" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="Image">Exsting Image:</label>
              <div class="col-sm-8">          
                <img src="" class="img-thumbnail" style="height: 100px;" id="exist_img">
              </div>
            </div>              
            <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-secondary mr-4" id="update_reset">Reset</button>
                <button type="submit" class="btn btn-info">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>
  <!-- ------------------------- -->

<style type="text/css">
    .error
    {
        color: red;
    }
</style>
@endsection
@section('scripts')


 
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <!-- { ! ! $chart->renderJs()  ! ! } -->

    <script type="text/javascript">
    $(document).ready(function() 
    {
        $("#basic-form").validate();

        $('#add_new_Restaurant').click(function()
          {
            $("#update_reset, #add_reset").click();
          });


        $('.btn_edit').click(function()
          {
             //alert($(this).attr('datalist'));
             $("#EditModal").modal('show');
             $("#update_reset, #add_reset").click();

             let Restaurant_id = $(this).attr('datalist');

             if(Restaurant_id)
          {
            $.ajax({
                 
                type: "get",          
                url: "{{url('admin/Restaurant')}}/ "+ Restaurant_id ,
                dataType: "json",
                data: {"_token": "{{ csrf_token()}}"},
                success : function(response)
                {


                  console.log(response['data']);

                  $('#up_name').val(response['data'][0].Rest_Name);
                  $('#up_Code').val(response['data'][0].Rest_Code);
                  $('#up_Description').val(response['data'][0].Rest_Desc);
                  $('#up_Phone').val(response['data'][0].phone);
                  $('#up_email').val(response['data'][0].email);
                  let path = $(location).attr("origin");
                  $('#exist_img').attr('src',path+"/"+response['data'][0].image);
                 // $('#update-form').attr('action',path+"/"+"admin/Restaurant/update/"+response['data'][0].id);
                  $('#up_restid').val(response['data'][0].id);
                   
                }
              });
            }
            else
            {
              alert("Please Select Product Type");
            }
          });


        $('.btn_delete').click(function()
          {
            if (!confirm("Do you want to delete"))
            {
              return false;
            }
          });

    });
</script>
@endsection