<section class="grid">
    <article class="card">
        <h3>Doanh thu</h3>
        <p><strong><?= number_format($kpi['revenue'], 0, ',', '.') ?> đ</strong></p>
    </article>
    <article class="card">
        <h3>Đơn hàng tháng</h3>
        <p><strong><?= $kpi['orders'] ?></strong></p>
    </article>
    <article class="card">
        <h3>Người dùng mới</h3>
        <p><strong><?= $kpi['newUsers'] ?></strong></p>
    </article>
    <article class="card">
        <h3>Tồn kho thấp</h3>
        <p><strong><?= $lowStock ?></strong></p>
    </article>
</section>

<section class="card" style="margin-top:16px;">
    <h2>Sách nổi bật</h2>
    <?php foreach ($books as $book): ?>
        <div class="book">
            <div>
                <strong><?= htmlspecialchars($book['title']) ?></strong>
                <div>Tác giả: <?= htmlspecialchars($book['author']) ?></div>
            </div>
            <div><?= number_format($book['price'], 0, ',', '.') ?> đ</div>
        </div>
    <?php endforeach; ?>
</section>

<section class="grid" style="margin-top:16px;">
    <article class="card">
        <h3>Danh mục</h3>
        <?php foreach ($categories as $category): ?>
            <span class="badge"><?= htmlspecialchars($category) ?></span>
        <?php endforeach; ?>
    </article>
    <article class="card">
        <h3>Tổng quan hệ thống</h3>
        <p>Đơn hàng gần đây: <?= $recentOrders ?></p>
        <p>Voucher đang hoạt động: <?= $activeCoupons ?></p>
    </article>
</section>
