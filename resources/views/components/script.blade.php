


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-multiselect@0.9.13/dist/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<script type="text/javascript" src="{{asset('public/assets/dist/jkanban.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dragula@3.7.3/dist/dragula.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.1"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<!-- Zoom -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel"]');
    const sidePanel = document.getElementById('panel');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel-new"]');
    const sidePanel = document.getElementById('panel-new');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel-unit"]');
    const sidePanel = document.getElementById('panel-unit');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});
</script>

<script type="text/javascript">
    var zoom = 1;
    $('.zoom').on('click', function() {
        zoom += 0.1;
        $('.board-cards').css('transform', 'scale(' + zoom + ')');
    });
    $('.zoom-init').on('click', function() {
        zoom = 1;
        $('.board-cards').css('transform', 'scale(' + zoom + ')');
    });
    $('.zoom-out').on('click', function() {
        zoom -= 0.1;
        $('.board-cards').css('transform', 'scale(' + zoom + ')');
    });
</script>
<!-- Scrolable -->
<script>


var currentSectionIndices = {};
var sectionWidth = sections[0].offsetWidth;



function shiftLeft(x) {
    var container = document.querySelector("#container-scroll-" + x);
    var sections = Array.from(document.querySelectorAll("#section-" + x));
    
    if (!currentSectionIndices[x]) {
        currentSectionIndices[x] = 0;
    }

    if (currentSectionIndices[x] > 0) {
        currentSectionIndices[x]--;
        var sectionWidth = sections[0].offsetWidth;
        container.style.transform = `translateX(-${sectionWidth * currentSectionIndices[x]}px)`;
    }
}

function shiftRight(x) {
    var container = document.querySelector("#container-scroll-" + x);
    var sections = Array.from(document.querySelectorAll("#section-" + x));
    
    if (!currentSectionIndices[x]) {
        currentSectionIndices[x] = 0;
    }

    if (currentSectionIndices[x] < sections.length - 1) {
        currentSectionIndices[x]++;
        var sectionWidth = sections[0].offsetWidth;
        container.style.transform = `translateX(-${sectionWidth * currentSectionIndices[x]}px)`;

        
    }
    

}

function shift(x) {
    
const currentDate = new Date();
const currentMonthNumber = currentDate.getMonth() + 1;


if(currentMonthNumber > 9)
{
 currentSectionIndex = 2;
    
}


if(currentMonthNumber > 6  && currentMonthNumber < 10)
{
 currentSectionIndex = 1;
    
}

if(currentMonthNumber > 3 && currentMonthNumber < 7)
{
 currentSectionIndex = 0;
    
}    
 
var container = document.querySelector("#container-scroll-" + x);
var sections = Array.from(document.querySelectorAll("#section-"+x));
    
    if (currentSectionIndex < sections.length - 1) {
        currentSectionIndex++;
        
        var sectionWidth = sections[0].offsetWidth;
        container.style.transform = `translateX(-${sectionWidth * currentSectionIndex}px)`;

    }
    
}


function handleDivClick(x)
{
         $.ajax({
         type: "GET",
        url: "{{ url('get-month') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        x:x,

        },
        success: function(response) {
            
            // $("#initiative"+x).collapse('toggle');  
            if(response.loop_index)
            {
            currentSectionIndices[x] = response.loop_index;
 
            }else
            {
            currentSectionIndices[x] = 0;
            }
            var container = document.querySelector("#container-scroll-" + x);
            var sections = Array.from(document.querySelectorAll("#section-"+x));
    

               var sectionWidth = sections[0].offsetWidth;
               container.style.transform = `translateX(-${sectionWidth * currentSectionIndices[x]}px)`;

    
        }
        
    });  
    

}


</script>
<!-- Kanban -->

<script>
    // Initialize Dragula
    
      

    
var containers = Array.from(document.getElementsByClassName("board"));
var drake = dragula(containers);

// Save position on drop
drake.on("drop", function (el, target, source, sibling) {
    var parentElId = target.id;
    var droppedElId = el.id;

    // Perform additional operations or AJAX request here
    // Example: Update the position of the card using AJAX
    $.ajax({
        type: "POST",
        url: "{{ url('change-epic-month') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        parentElId:parentElId,
        droppedElId:droppedElId,
        
      

        },
        success: function(response) {
            console.log('Card position updated successfully.');
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
});



    var containers = Array.from(document.getElementsByClassName("boards"));
    var drake = dragula(containers);

    // Save position on drop
    drake.on("drop", function (el, target, source, sibling) {
        var backlogId = el.id.split("-")[1];
        var newPosition = Array.from(target.children).indexOf(el) + 1;
      
     
        $.ajax({
        type: "POST",
        url: "{{ url('change-backlog-pos') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        backlogId:backlogId,
        newPosition:newPosition,
        
      

        },
        success: function(response) {
            console.log('Card position updated successfully.');
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
    });


  </script>

  <!-- Tooltip -->

  <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Datatable -->

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('.data-table').DataTable();
    });
    $(document).ready(function() {
    $('.search-team').select2({
      width: '100%',
    });
  });
  
  $(function() {

 $('#chkveg').val('');
  $('#chkveg').multiselect({
    includeSelectAllOption:false,
  });


});

    $(".js-select2").select2({
			closeOnSelect : false,
			placeholder : "Placeholder",
			// allowHtml: true,
			allowClear: true,
			tags: true // создает новые опции на лету
		});
  

</script>


<!-- Shahzad's Added for preventing the Add epics button to not dragable -->

<script>
// Initialize dragula
var drake = dragula([document.querySelector('.board')]);

drake.on('drop', function(el, target, source, sibling) {
    // Check if the dragged element has a specific class (e.g., 'unmovable')
    if (el.classList.contains('no-drag')) {
        // Prevent the element from moving to another column
        drake.cancel();
    } else {
        // Handle the normal drag-and-drop logic
        // You may want to update the element's position in your data structure
    }
});


</script>

  


<!-- Summernote -->

<script>
    $(document).ready(function() {
        $('#editor').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']],
            ],
        });
    });
</script>
