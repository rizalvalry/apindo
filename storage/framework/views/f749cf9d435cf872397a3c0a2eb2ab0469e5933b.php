
<?php $__env->startSection('title','Sign Up'); ?>
<?php $__env->startSection('banner_heading'); ?>
    <?php echo app('translator')->get('Register'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-section">
        <div class="overlay">
       <div class="container">
          <div class="row justify-content-center">
             <div class="col-lg-8">
                <div class="form-wrapper d-flex align-items-center">
                   <form action="<?php echo e(route('register')); ?>" method="post">
                     <?php echo csrf_field(); ?>
                      <div class="row g-4">
                         <div class="col-12">
                            <h4><?php echo app('translator')->get('register here'); ?></h4>
                         </div>
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="firstname"
                               value="<?php echo e(old('firstname')); ?>"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('First name'); ?>"
                            />
                         </div>
                         <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="lastname"
                               value="<?php echo e(old('lastname')); ?>"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('Last name'); ?>"
                            />
                         </div>
                         <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="username"
                               value="<?php echo e(old('username')); ?>"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('Username'); ?>"
                            />
                         </div>
                         <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                            <input
                               type="text"
                               name="email"
                               value="<?php echo e(old('email')); ?>"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('Email Address'); ?>"
                            />
                         </div>
                         <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                           <?php
                              $country_code = (string) @getIpInfo()['code'] ?: null;
                              $myCollection = collect(config('country'))->map(function($row) {
                                 return collect($row);
                              });
                              $countries = $myCollection->sortBy('code');
                           ?>
                          <div class="row">
                              <div class="col-4">
                                  <select name="phone_code" class="form-control country_code dialCode-change">
                                      <?php $__currentLoopData = config('country'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($value['phone_code']); ?>"
                                                  data-name="<?php echo e($value['name']); ?>"
                                                  data-code="<?php echo e($value['code']); ?>"
                                              <?php echo e($country_code == $value['code'] ? 'selected' : ''); ?>

                                          > <?php echo e($value['name']); ?> (<?php echo e($value['phone_code']); ?>)
                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                              </div>
                              <div class="col-8">
                                  <input type="text" name="phone" class="form-control dialcode-set" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo app('translator')->get('Phone Number'); ?>">
                                  <input type="hidden" name="country_code" value="<?php echo e(old('country_code')); ?>" class="text-dark">
                              </div>
                          </div>
                         </div>
                         <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                           <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                            <input
                               type="password"
                               name="password"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('Password'); ?>"
                            />
                         </div>
                         <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                         <div class="input-box col-12">
                            <input
                               type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="<?php echo app('translator')->get('Confirm Password'); ?>"
                            />
                         </div>

                          <?php if(basicControl()->reCaptcha_status_registration): ?>
                              <div class="col-md-6 box mb-4 form-group">
                                  <?php echo NoCaptcha::renderJs(session()->get('trans')); ?>

                                  <?php echo NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'light'] : []); ?>

                                  <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                  <span class="text-danger mt-1"><?php echo app('translator')->get($message); ?></span>
                                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              </div>
                          <?php endif; ?>

                         <div class="col-12">
                            <div class="links">

                            </div>
                         </div>
                      </div>
                      <button class="btn-custom w-100"><?php echo app('translator')->get('sign up'); ?></button>
                      <div class="bottom">
                         <?php echo app('translator')->get('Already have an account?'); ?>
                         <a href="<?php echo e(route('login')); ?>"><?php echo app('translator')->get('Login here'); ?></a>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        $(document).ready(function () {
            setDialCode();
            $(document).on('change', '.dialCode-change', function () {
                setDialCode();
            });
            function setDialCode() {
                let currency = $('.dialCode-change').val();
                $('.dialcode-set').val(currency);
            }

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/auth/register.blade.php ENDPATH**/ ?>