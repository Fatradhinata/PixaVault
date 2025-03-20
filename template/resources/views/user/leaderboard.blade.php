@extends('templates.user')

@section('title', 'Leaderboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endsection

@section('navbar')
    @include('components.navbar-black')
@endsection

@section('content')
    <div class="container">
        <div class="header">
            <h3>LEADERBOARD</h3>
            <p>Members with the most likes on content added in the last 4 weeks.</p>
        </div>
        <div class="tab-header">
            <div class="tab-nav">
                <button class="tab-btn active" data-tab="most-likes">
                    Most Likes
                </button>
                <button class="tab-btn" data-tab="most-downloads">
                    Most Downloads
                </button>
            </div>
        </div>
        <!-- Gallery -->
        <div class="row tab-content active" id="most-likes">
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>1</h3>
                    <div class="user-detail-core">
                        <img src="{{ asset('img/faces/user.png') }}" alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Kelly Austin</p>
                                <p class="download-total">7K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739862836703-03eca4457f77?q=80&w=1936&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739582767430-5b09cc50d6f6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739761613270-a48d0d1190ba?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>2</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1610276198568-eb6d0ff53e48?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Amelia Lidgra</p>
                                <p class="download-total">6.5K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1734514490597-ebb4dad5a047?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1702569111312-ede2d5a1989e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739614621579-8f8f396c7412?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>3</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1552234994-66ba234fd567?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Bridge Ledger</p>
                                <p class="download-total">6.2K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>4</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1531384441138-2736e62e0919?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Vince Kursel</p>
                                <p class="download-total">6K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1585951301678-8fd6f3b32c7e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 7">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737478598284-b9bc11cb1e9b?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 8">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737496538329-a59d10148a08?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 9">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>5</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1513956589380-bad6acb9b9d4?q=80&w=1536&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Yile Pole</p>
                                <p class="download-total">5K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="{{ asset('img/foto/category/nature.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/landscape.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/urban-cityscape.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>6</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1534030347209-467a5b0ad3e6?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Kurlione</p>
                                <p class="download-total">4.9K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>7</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1629444291470-b9ad6e7a88e1?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Jelo Perez</p>
                                <p class="download-total">4.6K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675873580364-8845f681b4ed?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737535614450-ce142f8e2953?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737373463158-0dec3d42035d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>8</h3>
                    <div class="user-detail-core">
                        <img src="https://plus.unsplash.com/premium_photo-1674639437824-771a65f1738b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Mark Swag</p>
                                <p class="download-total">4.4K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1585951301678-8fd6f3b32c7e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 7">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737478598284-b9bc11cb1e9b?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 8">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737496538329-a59d10148a08?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 9">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>9</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1499996860823-5214fcc65f8f?q=80&w=1966&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Miller Nano</p>
                                <p class="download-total">4.3K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="{{ asset('img/foto/category/nature.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/landscape.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/urban-cityscape.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>10</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1601972653460-fe3048709178?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Finn Sweed</p>
                                <p class="download-total">2K Likes</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row tab-content" id="most-downloads">
        <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>1</h3>
                    <div class="user-detail-core">
                        <img src="{{ asset('img/faces/user.png') }}" alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Kelly Austin</p>
                                <p class="download-total">7K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739862836703-03eca4457f77?q=80&w=1936&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739582767430-5b09cc50d6f6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739761613270-a48d0d1190ba?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>2</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1610276198568-eb6d0ff53e48?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Amelia Lidgra</p>
                                <p class="download-total">6.5K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1734514490597-ebb4dad5a047?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1702569111312-ede2d5a1989e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1739614621579-8f8f396c7412?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>3</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1552234994-66ba234fd567?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Bridge Ledger</p>
                                <p class="download-total">6.2K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>4</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1531384441138-2736e62e0919?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Vince Kursel</p>
                                <p class="download-total">6K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1585951301678-8fd6f3b32c7e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 7">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737478598284-b9bc11cb1e9b?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 8">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737496538329-a59d10148a08?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 9">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>5</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1513956589380-bad6acb9b9d4?q=80&w=1536&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Yile Pole</p>
                                <p class="download-total">5K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="{{ asset('img/foto/category/nature.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/landscape.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/urban-cityscape.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>6</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1534030347209-467a5b0ad3e6?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Kurlione</p>
                                <p class="download-total">4.9K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>7</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1629444291470-b9ad6e7a88e1?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Jelo Perez</p>
                                <p class="download-total">4.6K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675873580364-8845f681b4ed?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737535614450-ce142f8e2953?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737373463158-0dec3d42035d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>8</h3>
                    <div class="user-detail-core">
                        <img src="https://plus.unsplash.com/premium_photo-1674639437824-771a65f1738b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Mark Swag</p>
                                <p class="download-total">4.4K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1585951301678-8fd6f3b32c7e?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 7">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737478598284-b9bc11cb1e9b?q=80&w=2073&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 8">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1737496538329-a59d10148a08?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Random Image 9">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>9</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1499996860823-5214fcc65f8f?q=80&w=1966&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Miller Nano</p>
                                <p class="download-total">4.3K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="{{ asset('img/foto/category/nature.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/landscape.jpg') }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset('img/foto/category/urban-cityscape.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="leaderboard-row">
                <div class="user-detail">
                    <h3>10</h3>
                    <div class="user-detail-core">
                        <img src="https://images.unsplash.com/photo-1601972653460-fe3048709178?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="user">
                        <div class="user-name">
                            <div>
                                <p class="username">Finn Sweed</p>
                                <p class="download-total">2K Downloads</p>
                            </div>
                            <button>Follow</button>
                        </div>
                    </div>
                </div>
                <div class="user-content">
                    <div>
                        <img src="https://images.unsplash.com/photo-1739369763819-719454d3cdbe?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1738189669835-61808a9d5981?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                    <div>
                        <img src="https://plus.unsplash.com/premium_photo-1675805016071-6974f69a9a41?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/leaderboard.js') }}"></script>
@endsection