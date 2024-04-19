<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Alumni Directory</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Alumni Directory</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<section id="page-content-wrap" class="full-row bg-white">
    <div class="directory-page-content-warp section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="directory-text-wrap">
                        <h2>Now we have <strong class="funfact-count">485,274</strong> members </h2>
                        <div class="table-search-area">
                            <form action="#" class="selecting-command d-flex flex-wrap justify-content-center">
                                <input type="text" class="form-control" placeholder="Type Your Keyword Here">
                                <div class="select-arrow">
                                    <select name="dept" class="form-control form-select bg-gray">
                                        <option selected="">Dept</option>
                                        <option value="cmt">Computer</option>
                                        <option value="cmt">Computer</option>
                                        <option value="cmt">Computer</option>
                                        <option value="cmt">Computer</option>
                                        <option value="cmt">Computer</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>

                        <p class="show-memeber text-end">
                            Show <span>30</span> of <span>12487 Member</span>
                        </p>

                        <div class="directory-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <img src="<?php echo base_url('public/assets/club/homex/assets/images/team/01.jpg');?>" alt="table">
                                            <span>Angelina Jolie Voight<br>
                                            <b>A brief Bio here</b></span>
                                        </td>
                                        <td>Computer Science</td>
                                        <td>Web Developer</td>
                                        <td>Google</td>
                                        <td>Texas</td>
                                        <td>2012</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-wrap text-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">50</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>