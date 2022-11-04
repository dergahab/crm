<div class="row">
   <div class="col-md-12">
    <div class="form-group">
        <label for="">İcazə adı</label>
        <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
      </div>
   </div>
   <div class="col-md-12 pt-5">
    @foreach ($permitions as $permition)
        <ul>
            <li>{{$permition->name}}</li>
        </ul>
    @endforeach
   </div>
</div>