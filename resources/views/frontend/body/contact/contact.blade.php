
<div class="container">
    <section class="breadcrumbs mb-3 ">
    <ul class="d-flex align-items-center">
        <li><a href="#">Home</a></li>
        <li><a href="#">Option</a></li>
        <li><span>Active</span></li>
    </ul>
</section>
<div class="row my-5">
    <div class="col-sm-4 offset-sm-1 p-0">
        <div class="contact_us-info">
            <div class="contact_us-info--details">
                <div class="address">
                    <h3>
                        Contact address
                    </h3>
                    <p> Sundhara-5, Baghdwar  <br>
                        Kathmandu, Nepal</p>
                </div>
                <div class="phone">
                    <h3>Phone</h3><p> 01-4429249 <br> +977-9846598762</p></div>
                <div class="email"> <h3>Email</h3><p> info@daien.org.np</p></div>
            </div>
        </div>
    </div>
    <div class="col-sm-5  offset-sm-1 box-shadow mt-sm-0 mt-5">
        <div class="heading">
            <h3 class="py-2">
                Contact us
            </h3>
        </div>
        <div class="contact_us-form uk-margin">
        <form action="{{route('contact.us')}}" class="contact-form" method="post">
            @csrf
                <div class="form-group">
                    <input type="text" id="name" class="form-control" placeholder="Enter Your Name" name="name" value="" required="required">
                </div>
                <div class="form-group">

                    <input type="email" id="email" class="form-control" placeholder="Enter Your Email" name="email" value="" required="required">
                </div>

                <textarea name="message" class="form-control uk-margin-bottom" rows="8" id="message" placeholder="Message..."></textarea>


                <button type="submit" class="btn btn-primary  float-right">Send Message</button>
            </form>
        </div>
    </div>
</div>
</div>