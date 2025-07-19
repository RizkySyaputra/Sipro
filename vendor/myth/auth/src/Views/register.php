<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">
                <h2 class="card-header"><?= lang('Auth.register') ?></h2>
                <div class="card-body">

                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <form action="<?= url_to('register') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="id_provinsi">Provinsi</label>
                            <select name="id_provinsi" class="form-control <?php if (session('errors.id_provinsi')) : ?>is-invalid<?php endif ?>">
                                <option value="">-- Pilih Provinsi --</option>
                                <?php foreach ($provinsi as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= old('id_provinsi') == $p['id'] ? 'selected' : '' ?>><?= $p['provinsi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_unor">UNOR</label>
                            <select name="id_unor" class="form-control <?php if (session('errors.id_unor')) : ?>is-invalid<?php endif ?>">
                                <option value="">-- Pilih UNOR --</option>
                                <?php foreach ($unor as $u): ?>
                                    <option value="<?= $u->id ?>" <?= old('id_unor') == $u->id ? 'selected' : '' ?>><?= $u->unor ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                    </form>

                    <hr>

                    <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>