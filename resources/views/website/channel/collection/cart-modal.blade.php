<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">My Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="design-process-section" id="process-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- design process steps-->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">
                                    <li role="presentation" class="active"><a href="#cartlist"
                                            aria-controls="cartlist" role="tab" data-toggle="tab"><i
                                                class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            <p>Cart</p>
                                        </a></li>
                                    {{-- <li role="presentation" class=" "><a href="#startdate"
                                            aria-controls="startdate" role="tab" data-toggle="tab"><i
                                                class="fas fa-calendar " aria-hidden="true"></i>
                                            <p>Starting Date</p>
                                        </a></li> --}}
                                    <li role="presentation"><a href="#checkout" id="checkout-tab"
                                            aria-controls="checkout" role="tab" data-toggle="tab"><i
                                                class="fas fa-money-check-alt" aria-hidden="true"></i>
                                            <p>Checkout</p>
                                        </a></li>
                                    </li>
                                </ul>
                                <!-- end design process steps-->
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="cartlist">
                                        <div class="design-process-content">



                                            <h3 class="semi-bold">Cart Items List</h3>
                                            <table width="100%" class="table table-hover" id="my-cart-table">
                                                <thead width="100%">
                                                    <tr>
                                                        {{-- <th></th> --}}
                                                        <th style="text-align: left;">Title</th>
                                                        <th>Host</th>
                                                        <th style="text-align: left;">Duration</th>
                                                        <th style="width: 30px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart" width="100%">

                                                    <tr>
                                                        {{-- <td></td> --}}
                                                        <td></td>
                                                        <td style="text-align: right;"><strong>Total Videos</strong>
                                                        </td>
                                                        <td><strong id="my-cart-grand-total"
                                                                class="total"></strong></td>
                                                        <td style="width:30px"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="startdate">
                                        <div class="design-process-content">
                                            <h3 class="semi-bold">Start Date</h3>

                                            <label for="starts_on_date">Starting Date</label><br />
                                            <span class="text-muted">Please choose a date and time where your rental
                                                starts.</span>
                                            <div class="form-group  col-sm-8 col-md-6">
                                                <div class="input-group date" id="starts_on_date"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#starts_on_date" />
                                                    <div class="input-group-append" data-target="#starts_on_date"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-muted"><strong>Please Note:</strong> After your rental
                                                videos are active they will stay in <a
                                                    href="{{ route('myvideos.index') }}"><strong><u>'My Videos' page
                                                        </u></strong></a>for <strong>7 days</strong> until you play
                                                them. As soon as you start watching a video it'll stay in you account
                                                for <strong>24 hrs</strong> only.</p>


                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="checkout">


                                        <div class="design-process-content">
                                            <h3>Pay using Package</h3>
                                            <div style="text-align: center;" class="spin-8">
                                                <svg class=" slow-spin fa-refresh" aria-hidden="true" focusable="false"
                                                    data-prefix="fas" data-icon="sun" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    class="svg-inline--fa fa-sun fa-w-16 fa-spin fa-lg">
                                                    <path fill="currentColor"
                                                        d="M256 160c-52.9 0-96 43.1-96 96s43.1 96 96 96 96-43.1 96-96-43.1-96-96-96zm246.4 80.5l-94.7-47.3 33.5-100.4c4.5-13.6-8.4-26.5-21.9-21.9l-100.4 33.5-47.4-94.8c-6.4-12.8-24.6-12.8-31 0l-47.3 94.7L92.7 70.8c-13.6-4.5-26.5 8.4-21.9 21.9l33.5 100.4-94.7 47.4c-12.8 6.4-12.8 24.6 0 31l94.7 47.3-33.5 100.5c-4.5 13.6 8.4 26.5 21.9 21.9l100.4-33.5 47.3 94.7c6.4 12.8 24.6 12.8 31 0l47.3-94.7 100.4 33.5c13.6 4.5 26.5-8.4 21.9-21.9l-33.5-100.4 94.7-47.3c13-6.5 13-24.7.2-31.1zm-155.9 106c-49.9 49.9-131.1 49.9-181 0-49.9-49.9-49.9-131.1 0-181 49.9-49.9 131.1-49.9 181 0 49.9 49.9 49.9 131.1 0 181z"
                                                        class=""></path>
                                                </svg>
                                            </div>
                                            <div id="package-list">
                                            </div>
                                            <p class="my-3"> Would you like to add a package to your account?
                                                <a class="btn btn-dark mt-2"
                                                    href="{{ route('gizepackages.index') }}">Top up Gize-Package</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <center>

                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
