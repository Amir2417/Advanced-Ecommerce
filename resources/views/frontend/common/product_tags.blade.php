@php 

    $tags_ens = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    $tags_bans = App\Models\Product::groupBy('product_tags_ban')->select('product_tags_ban')->get();

@endphp


<div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">@if(session()->get('language')=='bangla') পণ্য ট্যাগ @else Product tags @endif</h3>
        <div class="sidebar-widget-body outer-top-xs">
        @if(session()->get('language')=='bangla')
            @foreach($tags_bans as $tags_ban)
            <a class="item active" href="category.html">{{$tags_ban->product_tags_ban}}</a>
            @endforeach
        @else       
        @foreach($tags_ens as $tags_en)
            <a class="item active" href="category.html">{{$tags_en->product_tags_en}}</a>
        @endforeach
        @endif
         
            <!-- /.tag-list --> 
        </div>
          <!-- /.sidebar-widget-body --> 
</div>