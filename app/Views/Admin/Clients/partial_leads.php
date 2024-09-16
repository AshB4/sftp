<?php if (empty($leads)): ?>
    <tr>
        <td colspan="8">No leads found.</td>
    </tr>
<?php else: ?>
    <?php foreach ($leads as $lead): ?>
        <tr>
            <td><?= esc($lead['sh_status']) ?></td>
            <td><?= esc($lead['status']) ?></td>
            <td><?= esc($lead['first_name'] ?? '') ?></td>
            <td><?= esc($lead['last_name'] ?? '') ?></td>
            <td><?= esc($lead['email_address']) ?></td>
            <td><?= esc($lead['caller_phone']) ?></td>
            <td><?= esc($lead['source']) ?></td>
            <td><?= esc($lead['medium']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>
