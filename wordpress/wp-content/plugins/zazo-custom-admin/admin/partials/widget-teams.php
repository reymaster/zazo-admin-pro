<?php
// Template para o widget "Teams"
if (!defined('ABSPATH')) exit;
?>
<div class="teams-table-wrapper">
    <table class="teams-table">
        <thead>
            <tr>
                <th>TEAM</th>
                <th>RATING</th>
                <th>LAST MODIFIED</th>
                <th>MEMBERS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="team-info">
                        <div class="name">Product Management</div>
                        <div class="role">Product development & lifecycle</div>
                    </div>
                </td>
                <td class="rating">
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                </td>
                <td>21 Oct, 2024</td>
                <td class="members-list">
                    <img src="<?php echo get_avatar_url('member1@example.com', ['size' => '24']); ?>" alt="Member" class="member-avatar">
                    <img src="<?php echo get_avatar_url('member2@example.com', ['size' => '24']); ?>" alt="Member" class="member-avatar">
                </td>
            </tr>
            </tbody>
    </table>
</div>
