<ul>
    <li class="active"> <a href="?main=dashboard&token=<?=$token?>"><i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span></a> </li>
    <li class="list-divider"></li>
    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span
                class="menu-arrow"></span></a>
        <ul class="submenu_class" style="display: none;">
            <li><a href="?main=customers&ui=list&token=<?=$token?>"> All customers </a></li>
            <li><a href="?main=customers&ui=new&token=<?=$token?>"> Add Customer </a></li>
        </ul>
    </li>
    <li> <a href="?main=transaction&ui=deposit&token=<?=$token?>"><i class="far fa-money-bill-alt"></i> <span>Deposit</span></a> </li>
    <li> <a href="?main=transaction&ui=withdrawal&token=<?=$token?>"><i class="far fa-money-bill-alt"></i> <span>Withdrawal</span></a> </li>
    <li> <a href="?main=transaction&ui=pending&token=<?=$token?>"><i class="far fa-money-bill-alt"></i> <span>Pending</span></a> </li>
    <li> <a href="?main=transaction&ui=account&token=<?=$token?>"><i class="far fa-money-bill-alt"></i> <span>Account statment</span></a> </li>
    
    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Loan </span> <span
                class="menu-arrow"></span></a>
        <ul class="submenu_class" style="display: none;">
            <li><a href="all-staff.html"> Request form </a></li>
            <li><a href="all-staff.html"> Payment </a></li>
            <li><a href="edit-staff.html"> Statment </a></li>
            <li><a href="all-staff.html"> Due </a></li>
        </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Transfer </span> <span
                class="menu-arrow"></span></a>
        <ul class="submenu_class" style="display: none;">
            <li><a href="all-staff.html"> New Transfer </a></li>
            <li><a href="edit-staff.html"> Statment </a></li>
        </ul>
    </li>
    
    
    <li> <a href="?main=transaction&ui=deposit&token=<?=$token?>"><i class="far fa-money-bill-alt"></i> <span>Support</span></a> </li>
    
</ul>