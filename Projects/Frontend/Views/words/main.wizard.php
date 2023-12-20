<a href="{{URL::base('words/add')}}" class="btn btn-primary btn-lg"><i class="fas fa-plus"></i></a>
<div class="alert alert-warning mt-2"><b>Ümumi söz sayı: {{$totalRows}}</b></div>
<table class="table table-bordered mt-3">
  <thead>                  
    <tr>
      <th style="width: 10px">#</th>
      <th>Azərbaycan</th>
      <th>İngilis</th>
      <th>Çin</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row):
    <tr>
      <td  style="font-weight:bold">{{$say++}}</td>
      <td>{{$row->w_az}}</td>
      <td>{{$row->w_en}}</td>
      <td>{{$row->w_ch}}</td>
      <td><a href="{{URL::base('words/edit/'.$row->w_id)}}"><i class="fas fa-pen fa-lg"></i></a> &nbsp;<a href="{{URL::base('words/delete/'.$row->w_id)}}" onclick="return confirm('Silmək istədiyinizdən əminsiniz?');"><i class="fas fa-trash fa-lg"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$pagination}}