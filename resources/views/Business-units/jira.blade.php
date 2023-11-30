                                     @php
                                     $Backlog = DB::table('backlog_unit')->get();
                                     $jir = DB::table('jira_setting')->where('user_id',Auth::id())->first();
                                     @endphp
                                      <table id="example" class="table">
                                        <thead>
                                            <tr>
                                              
                                                   <td>
                                                            <label class="form-checkbox">
                                                                <input type="checkbox" id="checkAlljira">
                                                                <span class="checkbox-label"></span>
                                                            </label>
                                                        </td>
                                                <td>Summary</td>
                                                <td>Description</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @if(count($jiradata) > 0)
                                             @foreach($jiradata as $data)
                                            <tr>
                                                 <td>
                                                    <label class="form-checkbox">
                                                        <input type="checkbox"  value="{{$data->id}}" name="jira_epic[]"> 
                                                        <span class="checkbox-label"></span>
                                                    </label>
                                                </td>
                                                
                                             
                                                <td>{{$data->Summary}}</td>
                                                <td>{{$data->detail}}</td>
                                            </tr>
                                             @endforeach
                                            @endif
                                      
                                        </tbody>
                                    </table>
                                    
                                    <div class="col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" value="off" name="flex" @if($jir) @if($jir->sync == 'off') checked @endif @endif id="flexRadioDefault1" >
                                      <label class="form-check-label ml-2 mt-1" for="flexRadioDefault1">
                                        One time download
                                      </label>
                                    </div>
                                    <div class="form-check mt-1">
                                      <input class="form-check-input" type="radio" name="flex" @if($jir) @if($jir->sync == 'on') checked @endif @endif value="on" id="flexRadioDefault2" >
                                      <label class="form-check-label ml-2 mt-1" for="flexRadioDefault2">
                                        Keep Synching
                                      </label>
                                    </div>
                                    </div>
                                    
                            <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Download</button>
                        </div>
                     
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {

      $('#checkAlljira').change(function() {
        $(':checkbox', 'tbody').prop('checked', this.checked);
      });
      
    

    });
    </script>
                                   