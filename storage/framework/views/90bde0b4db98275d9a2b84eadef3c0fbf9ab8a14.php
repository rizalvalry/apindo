<?php $__env->startSection('title',trans('Sign In')); ?>
<?php $__env->startSection('banner_heading'); ?>
    <?php echo app('translator')->get('Sign In'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="login-section">
        <div class="overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-wrapper d-flex align-items-center">
                            <form action="<?php echo e(route('login')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <h4><?php echo app('translator')->get('Login here'); ?></h4>
                                    </div>
                                    <div class="input-box col-12">
                                        <input
                                            type="text"
                                            name="username"
                                            class="form-control"
                                            autocomplete="off"
                                            autofocus="off"
                                            placeholder="<?php echo app('translator')->get('Email Or Username'); ?>"
                                        />
                                    </div>
                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                        class="text-danger float-left"><?php echo app('translator')->get($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger float-left"><?php echo app('translator')->get($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <div class="input-box col-12">
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control"
                                            placeholder="<?php echo app('translator')->get('Password'); ?>"
                                            autocomplete="off"
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

                                    <?php if(basicControl()->reCaptcha_status_login): ?>
                                        <div class="box mb-4 form-group">
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

                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="remember"
                                                    <?php echo e(old('remember') ? 'checked' : ''); ?>

                                                    id="flexCheckDefault"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="flexCheckDefault"
                                                >
                                                    <?php echo app('translator')->get('Remember me'); ?>
                                                </label>
                                            </div>

                                            <a href="<?php echo e(route('password.request')); ?>"
                                            ><?php echo app('translator')->get('Forgot password?'); ?></a
                                            >
                                        </div>
                                    </div>
                                </div>
                                <button class="btn-custom w-100"><?php echo app('translator')->get('sign in'); ?></button>
                                <div class="bottom">
                                    <?php echo app('translator')->get("Don't have an account?"); ?>

                                    <a href="<?php echo e(route('register')); ?>"><?php echo app('translator')->get('Create account'); ?></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>




<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/auth/login.blade.php ENDPATH**/ ?>