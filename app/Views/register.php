<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">person_add</i>
                </div>
                <h4 class="card-title"><?= lang('Auth.register') ?></h4>
            </div>
            <div class="card-body">

                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="email"><?= lang('Auth.email') ?></label>
                        <input type="email"
                            class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                            name="email"
                            value="<?= old('email') ?>"
                            placeholder="<?= lang('Auth.email') ?>">
                        <small class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                    </div>

                    <div class="form-group">
                        <label for="username"><?= lang('Auth.username') ?></label>
                        <input type="text"
                            class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
                            name="username"
                            value="<?= old('username') ?>"
                            placeholder="<?= lang('Auth.username') ?>">
                    </div>

                    <div class="form-group">
                        <label for="user"><?= lang('user') ?></label>
                        <input type="text"
                            class="form-control <?php if (session('errors.user')) : ?>is-invalid<?php endif ?>"
                            name="user"
                            value="<?= old('user') ?>"
                            placeholder="<?= lang('user') ?>">
                    </div>

                    <div class="form-group">
                        <label for="password"><?= lang('Auth.password') ?></label>
                        <input type="password"
                            name="password"
                            class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                            placeholder="<?= lang('Auth.password') ?>"
                            autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                        <input type="password"
                            name="pass_confirm"
                            class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                            placeholder="<?= lang('Auth.repeatPassword') ?>"
                            autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="id_provinsi">Provinsi</label>
                        <select name="id_provinsi"
                            class="form-control <?php if (session('errors.id_provinsi')) : ?>is-invalid<?php endif ?>">
                            <option value="">-- Pilih Provinsi --</option>
                            <?php foreach ($provinsi as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= old('id_provinsi') == $p['id'] ? 'selected' : '' ?>>
                                    <?= $p['provinsi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_unor">UNOR</label>
                        <select name="id_unor"
                            class="form-control <?php if (session('errors.id_unor')) : ?>is-invalid<?php endif ?>">
                            <option value="">-- Pilih UNOR --</option>
                            <?php foreach ($unor as $u): ?>
                                <option value="<?= $u->id ?>" <?= old('id_unor') == $u->id ? 'selected' : '' ?>>
                                    <?= $u->unor ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            <?= lang('Auth.register') ?>
                        </button>
                    </div>
                </form>

                <hr>
                <p>
                    <?= lang('Auth.alreadyRegistered') ?>
                    <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>