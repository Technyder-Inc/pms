</div>
    </main>
    
    <!-- Footer -->
    <footer class="app-footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> Property Management System. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="<?php echo isset($js_path) ? $js_path : ''; ?>app.js"></script>
    <?php if(isset($additional_js)) echo $additional_js; ?>
</body>
</html>