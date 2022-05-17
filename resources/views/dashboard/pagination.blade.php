<div class="text-center content-group-lg pt-20">
        <!---return boolean----->
@if($paginator->hasPages())

<ul class="pagination">

   <!---return boolean----->
@if($paginator->onFirstPage())

<li class="disabled">
      <a  href="{{$paginator->PreviousPageUrl()}}">   → Previous</a>
    </li>

    @else
    <li>
      <a  href="{{$paginator->PreviousPageUrl()}}" > → Previous</a>
    </li>
    @endif


 <!---return Array associative  Key and Value----->
    @if(is_array($elements[0]))
  @foreach($elements[0] as $pageNumber => $Url)

<li class="{{$pageNumber == $paginator->currentPage()||url()->current() == $Url ?  'active': '' }}"><a  href="{{$Url}}">{{$pageNumber}}</a></li>
  @endforeach

    @endif


     <!---return boolean----->
    @if($paginator->hasMorePages())
    <li>
      <a href="{{$paginator->nextPageUrl()}}">Next ←</a>
    </li>
    @else
    <li class="disabled">

      <a  href="{{$paginator->nextPageUrl()}}">Next ←</a>
    </li>

    @endif

</ul>


@endif
</div>


