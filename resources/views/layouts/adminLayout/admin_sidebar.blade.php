<?php  $url = url()->current(); ?>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="{{route('admin.dashboard')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{route('admin.category.add')}}">Add Category</a></li>
        <li><a href="{{route('admin.category.view')}}">View Category</a></li>

      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{route('admin.product.add')}}">Add Product</a></li>
        <li><a href="{{route('admin.product.view')}}">View Product</a></li>

      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{route('admin.coupon.add')}}">Add coupon</a></li>
        <li><a href="{{route('admin.coupon.view')}}">View coupon</a></li>

      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
      <ul>

        <li><a href="{{route('admin.order.view')}}">View order</a></li>


      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{route('admin.banner.add')}}">Add banner</a></li>
        <li><a href="{{route('admin.banner.view')}}">View banner</a></li>

      </ul>
    </li>


    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Users</span> <span class="label label-important">1</span></a>
      <ul>

        <li><a href="{{route('admin.users.viewUsers')}}">View user</a></li>
        <li><a href="{{route('admin.users.viewUsersCharts')}}">View user Charts</a></li>
        <li><a href="{{route('admin.users.viewUsersChartsYear')}}">View user Charts Years</a></li>

      </ul>
    </li>



        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admins/Sub Admins</span> <span class="label label-important">1</span></a>
          <ul>

            <li><a href="{{route('admin.addAdmins')}}">Add Admin/Sub Admin</a></li>

            <li><a href="{{route('admin.viewAdmins')}}">View Admins/Sub Admins</a></li>

          </ul>
        </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{route('admin.cms.add')}}">Add CMS Pages</a></li>
        <li><a href="{{route('admin.cms.view')}}">View CMS Pages</a></li>

      </ul>
    </li>

    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Order Chart</span> <span class="label label-important">2</span></a>
      <ul>
          <li><a href="{{route('admin.order.dailyCharts')}}">Daily Order Chart</a></li>
        <li><a href="{{route('admin.order.monthCharts')}}">Monthly Order Chart</a></li>
          <li><a href="{{route('admin.order.yearCharts')}}">Yearly Order Chart</a></li>


      </ul>
    </li>


  </ul>
</div>
<!--sidebar-menu-->
