<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h1>This is a sample website/not the complete one<h1>
e-commerce project using Laravel 8<br>
The template is free for educational purposes, you can download it from <a href="#"> here <a> <br>
<h1>The project contains two guards (user and admin):</h1>
<h3>the user can: </h3> 
<ul>
<li>browse products by recent products, category, subCategory, featured and hot-deals products.</li>
<li>filter products by category, price slider and other flexible attributes that can be added by admin.</li>
<li>search products.</li>
<li>add products to wishlist.</li>
<li>add products to cart and checkout (with or without coupons).</li>
<li>rate a product and write reviews.</li>
<li>track his orders, cancel or return an order.</li>
<li>other basic operations.</li>
</ul>

<p>the admins are classified by roles (using laravel Gates in middleware and views), which means each role has specific operations and limited access.</p>
<p>the admin can get real time notifications of customers' orders using laravel-websocket.</p>
<h3>admin roles are: </h3>
<ul>
<li>manage products.</li>
<li>manage product attributes, the admin can add new attribute with its values in manage attributes tab or when he is inserting new product.</li>
<li>manage site.</li>
<li>manage shipping areas.</li>
<li>manage orders (process, edit, delete, process return and cancel requests and many other things...).</li>
<li>manage coupons.</li>
<li>manage customers and other admins (super admin role).</li>
<li>other basic operations.</li>
</ul>
to run the project on your localhost follow the link <a href="https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/">setup laravel project</a> <br>
to setup websocket for real time notifications follow the link <a href="https://www.linkedin.com/pulse/how-create-simple-real-time-web-app-laravel-sylvan-cahilog?fbclid=IwAR3rg__qb5Xxzra_dx640Rdffk2INzOUl35nfNzPKx2rHpXq_2TcNQR59YU">laravel websocket tutorial</a>
