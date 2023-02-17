            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="{{ url('/') }}">
                            <img src="{{ asset('/images/brand/logo-white.png') }}" class="header-brand-img desktop-logo" alt="logo">
                            <img src="{{ asset('/images/brand/icon-white.png') }}" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="{{ asset('/images/brand/icon-dark.png') }}" class="header-brand-img light-logo" alt="logo">
                            <img src="{{ asset('/images/brand/logo-dark.png') }}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Main</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">@lang('dashboard.index')</span></a>
                            </li>
                            <li class="sub-category">
                                <h3>UI Kit</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-slack"></i><span
                                        class="side-menu__label">@lang('dashboard.apps')</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side1" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side2" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side1">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">@lang('dashboard.apps')</a></li>
                                                        <li><a href="{{ route('dashboard.users.index') }}" class="slide-item"> @lang('dashboard.users')</a></li>
                                                        <li><a href="calendar.html" class="slide-item"> Default calendar</a></li>
                                                        <li><a href="calendar2.html" class="slide-item"> Full calendar</a></li>
                                                        <li><a href="chat.html" class="slide-item"> Chat</a></li>
                                                        <li><a href="notify.html" class="slide-item"> Notifications</a></li>
                                                        <li><a href="sweetalert.html" class="slide-item"> Sweet alerts</a></li>
                                                        <li><a href="rangeslider.html" class="slide-item"> Range slider</a></li>
                                                        <li><a href="scroll.html" class="slide-item"> Content Scroll bar</a></li>
                                                        <li><a href="loaders.html" class="slide-item"> Loaders</a></li>
                                                        <li><a href="counters.html" class="slide-item"> Counters</a></li>
                                                        <li><a href="rating.html" class="slide-item"> Rating</a></li>
                                                        <li><a href="timeline.html" class="slide-item"> Timeline</a></li>
                                                        <li><a href="treeview.html" class="slide-item"> Treeview</a></li>
                                                        <li><a href="chart.html" class="slide-item"> Charts</a></li>
                                                        <li><a href="footers.html" class="slide-item"> Footers</a></li>
                                                        <li><a href="users-list.html" class="slide-item"> User List</a></li>
                                                        <li><a href="search.html" class="slide-item">Search</a></li>
                                                        <li><a href="crypto-currencies.html" class="slide-item"> Crypto-currencies</a></li>
                                                        <li><a href="widgets.html" class="slide-item"> Widgets</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="tab-pane" id="side2">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-package"></i><span
                                        class="side-menu__label">Bootstrap</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu mega-slide-menu">
                                    <li class="panel sidetab-menu">
                                        <div class="tab-menu-heading p-0 pb-2 border-0">
                                            <div class="tabs-menu ">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
													<li><a href="#side5" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side6" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body p-0 border-0">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="side5">
                                                    <ul class="sidemenu-list mega-menu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Bootstrap</a></li>
                                                        <li><a href="alerts.html" class="slide-item"> Alerts</a></li>
                                                        <li><a href="buttons.html" class="slide-item"> Buttons</a></li>
                                                        <li><a href="colors.html" class="slide-item"> Colors</a></li>
                                                        <li><a href="avatarsquare.html" class="slide-item"> Avatar Square</a></li>
                                                        <li><a href="avatar-radius.html" class="slide-item"> Avatar Radius</a></li>
                                                        <li><a href="avatar-round.html" class="slide-item"> Avatar Rounded</a></li>
                                                        <li><a href="dropdown.html" class="slide-item"> Dropdowns</a></li>
                                                        <li><a href="listgroup.html" class="slide-item"> List Group</a></li>
                                                        <li><a href="tags.html" class="slide-item"> Tags</a></li>
                                                        <li><a href="pagination.html" class="slide-item"> Pagination</a></li>
                                                        <li><a href="navigation.html" class="slide-item"> Navigation</a></li>
                                                        <li><a href="typography.html" class="slide-item"> Typography</a></li>
                                                        <li><a href="breadcrumbs.html" class="slide-item"> Breadcrumbs</a></li>
                                                        <li><a href="badge.html" class="slide-item"> Badges / Pills</a></li>
                                                        <li><a href="panels.html" class="slide-item"> Panels</a></li>
                                                        <li><a href="thumbnails.html" class="slide-item"> Thumbnails</a></li>
                                                        <li><a href="offcanvas.html" class="slide-item"> Offcanvas</a></li>
                                                        <li><a href="toast.html" class="slide-item"> toast</a></li>
                                                        <li><a href="scrollspy.html" class="slide-item"> Scrollspy</a></li>
                                                        <li><a href="mediaobject.html" class="slide-item"> Media Object</a></li>
                                                        <li><a href="accordion.html" class="slide-item"> Accordions </a></li>
                                                        <li><a href="tabs.html" class="slide-item"> Tabs</a></li>
                                                        <li><a href="modal.html" class="slide-item"> Modal</a></li>
                                                        <li><a href="tooltipandpopover.html" class="slide-item"> Tooltip and popover</a></li>
                                                        <li><a href="progress.html" class="slide-item"> Progress</a></li>
                                                        <li><a href="carousel.html" class="slide-item"> Carousels</a></li>
                                                        <li><a href="ribbons.html" class="slide-item"> Ribbons</a></li>
                                                    </ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="side6">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="side-menu__item has-link" href="landing-page.html" target="_blank"><i
                                        class="side-menu__icon fe fe-zap"></i><span
                                        class="side-menu__label">Landing Page</span><span class="badge bg-green br-5 side-badge blink-text pb-1">New</span></a>
                            </li>
                            <li class="sub-category">
                                <h3>Pre-build Pages</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-layers"></i><span
                                        class="side-menu__label">Pages</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>

								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side9" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side10" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side9">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Pages</a></li>
                                                        <li><a href="profile.html" class="slide-item"> Profile</a></li>
                                                        <li><a href="editprofile.html" class="slide-item"> Edit Profile</a></li>
                                                        <li><a href="notify-list.html" class="slide-item"> Notifications List</a></li>
                                                        <li><a href="email-compose.html" class="slide-item"> Mail-Compose</a></li>
                                                        <li><a href="email-inbox.html" class="slide-item"> Mail-Inbox</a></li>
                                                        <li><a href="email-read.html" class="slide-item"> Mail-Read</a></li>
                                                        <li><a href="gallery.html" class="slide-item"> Gallery</a></li>
                                                        <li class="sub-slide">
                                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                                    class="sub-side-menu__label">Forms</span><i
                                                                    class="sub-angle fe fe-chevron-right"></i></a>
                                                            <ul class="sub-slide-menu">
                                                                <li><a href="form-elements.html" class="sub-slide-item"> Form Elements</a>
                                                                </li>
                                                                <li><a href="form-layouts.html" class="sub-slide-item"> Form Layouts</a>
                                                                </li>
                                                                <li><a href="form-advanced.html" class="sub-slide-item"> Form Advanced</a>
                                                                </li>
                                                                <li><a href="form-editor.html" class="sub-slide-item"> Form Editor</a></li>
                                                                <li><a href="form-wizard.html" class="sub-slide-item"> Form Wizard</a></li>
                                                                <li><a href="form-validation.html" class="sub-slide-item"> Form Validation</a></li>
                                                                <li><a href="form-input-spinners.html" class="sub-slide-item"> Form Input Spinners</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="sub-slide">
                                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                                    class="sub-side-menu__label">Tables</span><i
                                                                    class="sub-angle fe fe-chevron-right"></i></a>
                                                            <ul class="sub-slide-menu">
                                                                <li><a href="tables.html" class="sub-slide-item">Default table</a></li>
                                                                <li><a href="datatable.html" class="sub-slide-item"> Data Tables</a></li>
                                                                <li><a href="edit-table.html" class="sub-slide-item"> Edit Tables</a></li>
                                                                <li><a href="extension-tables.html" class="sub-slide-item"> Extension Tables</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="sub-slide">
                                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                                    class="sub-side-menu__label">Extension</span><i
                                                                    class="sub-angle fe fe-chevron-right"></i></a>
                                                            <ul class="sub-slide-menu">
                                                                <li><a href="about.html" class="sub-slide-item"> About Company</a></li>
                                                                <li><a href="services.html" class="sub-slide-item"> Services</a></li>
                                                                <li><a href="faq.html" class="sub-slide-item"> FAQS</a></li>
                                                                <li><a href="terms.html" class="sub-slide-item"> Terms</a></li>
                                                                <li><a href="invoice.html" class="sub-slide-item"> Invoice</a></li>
                                                                <li><a href="pricing.html" class="sub-slide-item"> Pricing Tables</a></li>
                                                                <li><a href="settings.html" class="sub-slide-item"> Settings</a></li>
                                                                <li><a href="blog.html" class="sub-slide-item"> Blog</a></li>
                                                                <li><a href="blog-details.html" class="sub-slide-item"> Blog Details</a>
                                                                </li>
                                                                <li><a href="blog-post.html" class="sub-slide-item"> Blog Post</a></li>
                                                                <li><a href="empty.html" class="sub-slide-item"> Empty Page</a></li>
                                                                <li><a href="construction.html" class="sub-slide-item"> Under
                                                                        Construction</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="switcher-1.html" class="slide-item"> Switcher</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side10">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-shopping-bag"></i><span
                                        class="side-menu__label">E-Commerce</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side13" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side14" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side13">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">E-Commerce</a></li>
                                                        <li><a href="shop.html" class="slide-item"> Shop</a></li>
                                                        <li><a href="shop-description.html" class="slide-item"> Product Details</a></li>
                                                        <li><a href="cart.html" class="slide-item"> Shopping Cart</a></li>
                                                        <li><a href="add-product.html" class="slide-item"> Add Product</a></li>
                                                        <li><a href="wishlist.html" class="slide-item"> Wishlist</a></li>
                                                        <li><a href="checkout.html" class="slide-item"> Checkout</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side14">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">File
                                        Manager</span><span class="badge bg-pink side-badge">4</span><i
                                        class="angle fe fe-chevron-right hor-angle"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side17" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side18" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side17">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">File Manager</a></li>
                                                        <li><a href="file-manager.html" class="slide-item"> File Manager</a></li>
                                                        <li><a href="filemanager-list.html" class="slide-item"> File Manager List</a></li>
                                                        <li><a href="filemanager-details.html" class="slide-item"> File Details</a></li>
                                                        <li><a href="file-attachments.html" class="slide-item"> File Attachments</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side18">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="sub-category">
                                <h3>Misc Pages</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Authentication</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side21" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side22" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side21">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Authentication</a></li>
                                                        <li><a href="login.html" class="slide-item"> Login</a></li>
                                                        <li><a href="register.html" class="slide-item"> Register</a></li>
                                                        <li><a href="forgot-password.html" class="slide-item"> Forgot Password</a></li>
                                                        <li><a href="lockscreen.html" class="slide-item"> Lock screen</a></li>
                                                        <li class="sub-slide">
                                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                                    class="sub-side-menu__label">Error Pages</span><i
                                                                    class="sub-angle fe fe-chevron-right"></i></a>
                                                            <ul class="sub-slide-menu">
                                                                <li><a href="400.html" class="sub-slide-item"> 400</a></li>
                                                                <li><a href="401.html" class="sub-slide-item"> 401</a></li>
                                                                <li><a href="403.html" class="sub-slide-item"> 403</a></li>
                                                                <li><a href="404.html" class="sub-slide-item"> 404</a></li>
                                                                <li><a href="500.html" class="sub-slide-item"> 500</a></li>
                                                                <li><a href="503.html" class="sub-slide-item"> 503</a></li>
                                                            </ul>
                                                        </li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side22">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                    <i class="side-menu__icon fe fe-cpu"></i>
                                    <span class="side-menu__label">Submenu items</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side25" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side26" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side25">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Submenu items</a></li>
                                                        <li><a href="javascript:void(0)" class="slide-item">Submenu-1</a></li>
                                                        <li class="sub-slide">
                                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                                    class="sub-side-menu__label">Submenu-2</span><i
                                                                    class="sub-angle fe fe-chevron-right"></i></a>
                                                            <ul class="sub-slide-menu">
                                                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.1</a></li>
                                                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.2</a></li>
                                                                <li class="sub-slide2">
                                                                    <a class="sub-side-menu__item2" href="javascript:void(0)"
                                                                        data-bs-toggle="sub-slide2"><span
                                                                            class="sub-side-menu__label2">Submenu-2.3</span><i
                                                                            class="sub-angle2 fe fe-chevron-right"></i></a>
                                                                    <ul class="sub-slide-menu2">
                                                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.1</a></li>
                                                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.2</a></li>
                                                                        <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.3</a></li>
                                                                    </ul>
                                                                </li>
                                                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.4</a></li>
                                                                <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.5</a></li>
                                                            </ul>
                                                        </li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side26">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="sub-category">
                                <h3>General</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-map-pin"></i><span
                                        class="side-menu__label">Maps</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side29" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side30" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side29">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Maps</a></li>
                                                        <li><a href="maps1.html" class="slide-item">Leaflet Maps</a></li>
                                                        <li><a href="maps2.html" class="slide-item">Mapel Maps</a></li>
                                                        <li><a href="maps.html" class="slide-item">Vector Maps</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side30">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-bar-chart-2"></i><span
                                        class="side-menu__label">Charts</span><span
                                        class="badge bg-secondary side-badge">6</span><i
                                        class="angle fe fe-chevron-right hor-angle"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side33" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side34" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side33">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Charts</a></li>
                                                        <li><a href="chart-chartist.html" class="slide-item">Chart Js</a></li>
                                                        <li><a href="chart-flot.html" class="slide-item"> Flot Charts</a></li>
                                                        <li><a href="chart-echart.html" class="slide-item"> ECharts</a></li>
                                                        <li><a href="chart-morris.html" class="slide-item"> Morris Charts</a></li>
                                                        <li><a href="chart-nvd3.html" class="slide-item"> Nvd3 Charts</a></li>
                                                        <li><a href="charts.html" class="slide-item"> C3 Bar Charts</a></li>
                                                        <li><a href="chart-line.html" class="slide-item"> C3 Line Charts</a></li>
                                                        <li><a href="chart-donut.html" class="slide-item"> C3 Donut Charts</a></li>
                                                        <li><a href="chart-pie.html" class="slide-item"> C3 Pie charts</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side34">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-wind"></i><span
                                        class="side-menu__label">Icons</span><i
                                        class="angle fe fe-chevron-right"></i>
                                </a>
								<ul class="slide-menu">
									<li class="panel sidetab-menu">
										<div class="tab-menu-heading p-0 pb-2 border-0">
											<div class="tabs-menu ">
												<!-- Tabs -->
												<ul class="nav panel-tabs">
													<li><a href="#side37" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
													<li><a href="#side38" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body p-0 border-0">
											<div class="tab-content">
												<div class="tab-pane active" id="side37">
													<ul class="sidemenu-list">
                                                        <li class="side-menu-label1"><a href="javascript:void(0)">Icons</a></li>
                                                        <li><a href="icons.html" class="slide-item"> Font Awesome</a></li>
                                                        <li><a href="icons2.html" class="slide-item"> Material Design Icons</a></li>
                                                        <li><a href="icons3.html" class="slide-item"> Simple Line Icons</a></li>
                                                        <li><a href="icons4.html" class="slide-item"> Feather Icons</a></li>
                                                        <li><a href="icons5.html" class="slide-item"> Ionic Icons</a></li>
                                                        <li><a href="icons6.html" class="slide-item"> Flag Icons</a></li>
                                                        <li><a href="icons7.html" class="slide-item"> pe7 Icons</a></li>
                                                        <li><a href="icons8.html" class="slide-item"> Themify Icons</a></li>
                                                        <li><a href="icons9.html" class="slide-item">Typicons Icons</a></li>
                                                        <li><a href="icons10.html" class="slide-item">Weather Icons</a></li>
                                                        <li><a href="icons11.html" class="slide-item">Bootstrap Icons</a></li>
													</ul>
                                                    <div class="menutabs-content mt-5 p-0">
                                                        <div class="Annoucement_card">
                                                            <div class="text-center">
                                                                <div>
                                                                    <h5 class="title mt-0 mb-1 ms-2 font-weight-bold tx-12"> Go for Premium Account </h5>
                                                                    <div class="bg-layer">
                                                                        <img src="{{ asset('/images/media/37.png') }}" alt="img" class="text-center mx-auto">
                                                                    </div>
                                                                    <p class="subtext mt-0 mb-0 ms-2 fs-13 text-center my-2"> $399.9 /Monthly</p>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                                        </div>
                                                    </div>
												</div>
												<div class="tab-pane" id="side38">
													<h5 class="mt-3 fw-600 mb-4">Recent Chats</h5>
                                                    <div class="main-chat-list tab-pane">
                                                        <div class="media border-0 px-1 new border-top-0">
                                                            <div class="main-img-user online">
                                                                <img alt="" src="{{ asset('/images/users/5.jpg') }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Raymart Santiago</span> <span>10 min</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <img alt="" src="{{ asset('/images/users/6.jpg') }}"> <span>3</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Ariana Monino</span> <span>30 min</span>
                                                                </div>
                                                                <p>Good Morning</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user online"><img alt="" src="{{ asset('/images/users/9.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Reynante Labares</span> <span>9.40 am</span>
                                                                </div>
                                                                <p> Nice to meet you </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Joyce Chua</span> <span>11.20 am</span>
                                                                </div>
                                                                <p> Hi, How are you? </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/4.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Rolando Paloso</span> <span>1.38 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user">
                                                                <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                                                </div>
                                                                <p>Typing...</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/21.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maricel Villalon</span> <span>8.09 pm</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Maryjane Pechon</span> <span>1 day ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/5.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Daniel Padilla</span> <span>5 days ago</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/3.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>John Pratts</span> <span>20/06/2021</span>
                                                                </div>
                                                                <p>I have some work</p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/7.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Socrates Itumay</span> <span>18/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                        <div class="media border-0 px-1 new border-bottom-0">
                                                            <div class="main-img-user"><img alt="" src="{{ asset('/images/users/6.jpg') }}"></div>
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>Samuel Lerin</span> <span>29/07/2021</span>
                                                                </div>
                                                                <p> Hey! there I'm available </p>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</li>
								</ul>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </div>
            </div>
