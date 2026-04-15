import { UserService }   from '../models/UserService.js';
import { UserFilter }    from '../filters/UserFilter.js';
import { UserValidator } from '../validators/UserValidator.js';
import { UserView }      from '../views/UserView.js';

const userService = new UserService();

/**
 * UserController — Controller v MVC.
 *
 * Prijíma HTTP požiadavku, koordinuje Filter → Validator → Model → View
 * a odošle odpoveď. Neobsahuje SQL ani žiadnu logiku formátovania.
 */
export class UserController {

    /**
     * GET /api/users
     */
    async index(req, res, next) {
        try {
            const users = await userService.findAll();
            UserView.list(res, users);
        } catch (err) {
            next(err);
        }
    }

    /**
     * GET /api/users/:id
     */
    async show(req, res, next) {
        try {
            const user = await userService.findById(Number(req.params.id));
            if (!user) return UserView.notFound(res);
            UserView.single(res, user);
        } catch (err) {
            next(err);
        }
    }

    /**
     * POST /api/users
     *
     * 1. Filter   — očistí surový vstup
     * 2. Validate — overí biznis pravidlá
     * 3. Model    — uloží do databázy
     * 4. View     — naformátuje a odošle odpoveď
     */
    async store(req, res, next) {
        try {
            // 1. Filter
            const data = UserFilter.forCreate(req.body);

            // 2. Validácia
            const errors = UserValidator.forCreate(data);
            if (errors.length) return UserView.validationError(res, errors);

            // 3. Model
            const user = await userService.create(data);

            // 4. View
            UserView.created(res, user);
        } catch (err) {
            if (err.code === '23505') {
                return UserView.validationError(res, ['Email je už obsadený.']);
            }
            next(err);
        }
    }

    /**
     * DELETE /api/users/:id
     */
    async destroy(req, res, next) {
        try {
            const deleted = await userService.deleteById(Number(req.params.id));
            if (!deleted) return UserView.notFound(res);
            UserView.deleted(res);
        } catch (err) {
            next(err);
        }
    }
}
