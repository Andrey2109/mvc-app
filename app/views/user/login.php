 <?php if (!empty($_SESSION['user_with_email_exists'])): ?>
     <div class="alert-message">
         <?= htmlspecialchars($_SESSION['user_with_email_exists']) ?>
     </div>
     <?php unset($_SESSION['user_with_email_exists']); ?>
 <?php endif; ?>


 <main class="container my-5">
     <h2 class="text-center mb-4">Login</h2>
     <div class="row justify-content-center">
         <div class="col-md-6">
             <form action="/login" method="post">
                 <div class="mb-3">
                     <label for="email" class="form-label">Email address *</label>
                     <input
                         name="email"
                         type="email"
                         class="form-control"
                         id="email"
                         required>
                 </div>
                 <div class="mb-3">
                     <label for="password" class="form-label">Password *</label>
                     <input
                         name='password'
                         type="password"
                         class="form-control"
                         id="password"
                         required>
                 </div>
                 <button type="submit" class="btn btn-primary w-100">Login</button>
             </form>
             <p class="mt-3 text-center">
                 Don't have an account? <a href="<?php echo base_url('/user/register') ?>">Register here</a>.
             </p>
         </div>
     </div>
 </main>