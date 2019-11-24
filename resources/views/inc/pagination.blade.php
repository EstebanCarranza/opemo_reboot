<div id="paginationRow" class="row">
    <div class="center">
        <ul class="pagination">
            <li id="pageLi1" class="element active">         <a id="page1" class="page">1</a></li>
            <li id="pageLi2" class="element waves-effect">   <a id="page2" class="page">2</a></li>
            <li id="pageLi3" class="element waves-effect">   <a id="page3" class="page">3</a></li>
            <li id="pageLi4" class="element waves-effect">   <a id="page4" class="page">4</a></li>
            <li id="pagePoints">...</li>
            <li id="pageLiLast" class="waves-effect"><a id="pageLast" class="element page">Ultimo</a></li>
            
        </ul>
    </div>
</div>

<script>
    $(document).ready(function()
    {
        $(".pagination .element").removeClass("orange");
        $(".pagination .active").addClass("orange");
        $("#paginationRow").hide();
        
    });
</script>