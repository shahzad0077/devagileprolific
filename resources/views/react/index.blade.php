@php
$var_objective = "Backlog-Unit";
@endphp
@extends('components.main-layout')
<title>Impediments </title>
@section('content')
<style>
    .tree {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #fbfbfb;
  border: 1px solid #999;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
}

.tree li {
  list-style-type: none;
  margin: 0;
  padding: 10px 5px 0 5px;
  position: relative
}

.tree li::before,
.tree li::after {
  content: '';
  left: -20px;
  position: absolute;
  right: auto
}

.tree li::before {
  border-left: 1px solid #999;
  bottom: 50px;
  height: 100%;
  top: 0;
}

.tree li::after {
  box-sizing: border-box;
  border-left: 1px solid #999;
  border-bottom: 1px solid #999;
  border-bottom-left-radius: 10px;
  height: 25px;
  top: 0px;
  width: 25px;
}

.tree li span {
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border: 1px solid #999;
  border-radius: 5px;
  display: inline-block;
  padding: 3px 8px;
  text-decoration: none;
}

.tree li.parent_li > span {
  cursor: pointer;
}

.tree > ul > li::before,
.tree > ul > li::after {
  border: 0;
}

.tree li:last-child::before {
  height: 14px;
}

.tree li:not(.parent_li) span {
  position: relative;
}

.tree li span:before {
  content: "";
  position: absolute;
  /* border-width - 1px */
  left: -4px;
  bottom: calc(50% - 4px);
  border-color: transparent;
  border-left-color: #999;
  border-style: inherit;
  border-width: 4px;
}

/* another styles for parent_li immediate span children */
.tree li.parent_li > span:before {
  bottom: initial;
  left: 2px;
  top: 20.5px;
}

/* hide arrow for immediate children */
.tree > ul > li > span:before {
  display: none;
}

.tree li.parent_li > span:hover,
.tree li.parent_li > span:hover + ul li span {
  background: #eee;
  border: 1px solid #94a0b4;
  color: #000;
}
</style>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <!-- begin page Content -->
            <div class="container-fluid py-7">
               	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <div class="tree well">
                  <ul>
                    <li>
                      <span><i class="fa fa-folder-open"></i> Parent</span> <a href="">Goes somewhere</a>
                      <ul>
                        <li>
                          <span><i class="fa fa-minus"></i> Child</span> <a href="">Goes somewhere</a>
                          <ul>
                            <li>
                              <span><i class="fa fa-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <span><i class="fa fa-minus"></i> Child</span> <a href="">Goes somewhere</a>
                          <ul>
                            <li>
                              <span><i class="fa fa-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
                            </li>
                            <li>
                              <span><i class="fa fa-minus"></i> Grand Child</span> <a href="">Goes somewhere</a>
                              <ul>
                                <li>
                                  <span><i class="fa fa-minus"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
                                  <ul>
                                    <li>
                                      <span><i class="fa fa-leaf"></i> Great great Grand Child</span> <a href="">Goes somewhere</a>
                                    </li>
                                    <li>
                                      <span><i class="fa fa-leaf"></i> Great great Grand Child</span> <a href="">Goes somewhere</a>
                                    </li>
                                  </ul>
                                </li>
                                <li>
                                  <span><i class="fa fa-leaf"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
                                </li>
                                <li>
                                  <span><i class="fa fa-leaf"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
                                </li>
                              </ul>
                            </li>
                            <li>
                              <span><i class="fa fa-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span><i class="fa fa-folder-open"></i> Parent2</span> <a href="">Goes somewhere</a>
                      <ul>
                        <li>
                          <span><i class="fa fa-leaf"></i> Child</span> <a href="">Goes somewhere</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>

                <div class="tree">
                  <ul>
                    <li>
                      <span><i class="icon-calendar"></i> 2013, Week 2</span>
                      <ul>
                        <li>
                          <span class="badge badge-success"><i class="fa fa-minus"></i> Monday, January 7: 8.00 hours</span>
                          <ul>
                            <li>
                              <a href=""><span><i class="icon-time"></i> 8.00</span> &ndash; Changed CSS to accomodate...</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <span class="badge badge-success"><i class="fa fa-minus"></i> Tuesday, January 8: 8.00 hours</span>
                          <ul>
                            <li>
                              <span><i class="icon-time"></i> 6.00</span> &ndash; <a href="">Altered code...</a>
                            </li>
                            <li>
                              <span><i class="icon-time"></i> 2.00</span> &ndash; <a href="">Simplified our approach to...</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <span class="badge badge-warning"><i class="fa fa-minus"></i> Wednesday, January 9: 6.00 hours</span>
                          <ul>
                            <li>
                              <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Fixed bug caused by...</a>
                            </li>
                            <li>
                              <a href=""><span><i class="icon-time"></i> 3.00</span> &ndash; Comitting latest code to Git...</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <span class="badge badge-important"><i class="fa fa-minus"></i> Wednesday, January 9: 4.00 hours</span>
                          <ul>
                            <li>
                              <a href=""><span><i class="icon-time"></i> 2.00</span> &ndash; Create component that...</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span><i class="icon-calendar"></i> 2013, Week 3</span>
                      <ul>
                        <li>
                          <span class="badge badge-success"><i class="fa fa-minus"></i> Monday, January 14: 8.00 hours</span>
                          <ul>
                            <li>
                              <span><i class="icon-time"></i> 7.75</span> &ndash; <a href="">Writing documentation...</a>
                            </li>
                            <li>
                              <span><i class="icon-time"></i> 0.25</span> &ndash; <a href="">Reverting code back to...</a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
            </div>
            <!-- end page content -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
      $('.tree li.parent_li > span').on('click', function(e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
          children.hide('fast');
          $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus').removeClass('fa-minus');
        } else {
          children.show('fast');
          $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus').removeClass('fa-plus');
        }
        e.stopPropagation();
      });
    });
</script>
@endsection