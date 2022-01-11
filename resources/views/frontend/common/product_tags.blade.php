@php
$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
     <h3 class="section-title">Product tags</h3>
     <div class="sidebar-widget-body outer-top-xs">

          <div class="tag-list">

               @php
               $tags_array = array();
               foreach($tags_en as $tag){
               foreach(explode(',', $tag->product_tags_en) as $onetag){
               array_push($tags_array, $onetag);
               }
               }
               $unique_tags = array_unique($tags_array);
               @endphp
               @foreach ($unique_tags as $tag)
               <a class="item active" href="{{ url('product/tag/'.$tag) }}">
                    {{$tag}}</a>
               @endforeach
          </div>
          <!-- /.tag-list -->
     </div>
     <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->