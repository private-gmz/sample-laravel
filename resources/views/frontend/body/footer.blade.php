<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->

          @php
          $setting = App\Models\SiteSetting::find(1);
          @endphp

          <div class="module-body">
            <ul class="toggle-footer">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                      class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>{{ $setting->company_name }}, {{ $setting->company_address }}</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                      class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>{{ $setting->phone_one }}<br>
                    {{ $setting->phone_two }}</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                      class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="#">{{ $setting->email }}</a></span> </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->




        <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="module-heading">
            <h4 class="module-title">Other Links</h4>
          </div>
          <!-- /.module-heading -->
          <div class="col-xs-12 col-sm-6 no-padding social">
            <ul>
              <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->facebook }}"
                  title="Facebook"></a></li>

              <li class="tw pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->twitter }}"
                  title="Twitter"></a></li>

              <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>

              <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>

              <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>

              <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->linkedin }}"
                  title="Linkedin"></a></li>

              <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="{{ $setting->youtube }}"
                  title="Youtube"></a></li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
      </div>
    </div>
  </div>

</footer>